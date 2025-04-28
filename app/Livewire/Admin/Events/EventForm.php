<?php

namespace App\Livewire\Admin\Events;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;
use DOMDocument;

class EventForm extends Component
{
    use WithFileUploads;

    public $eventId;
    public $event;
    public $title;
    public $description;
    public $event_date;
    public $tag;
    public $article;
    public $thumbnail;
    public $is_highlighted = 0;
    public $debugInfo = '';

    // listen for the Quill editor updates
    protected $listeners = [
        'quillChanged' => 'updateQuill'
    ];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'tag' => 'required|string|max:255',
            'article' => 'required|string',
            'thumbnail' => $this->eventId
                ? 'nullable|image|max:5120'
                : 'required|image|max:5120',
            'is_highlighted' => 'boolean',
        ];
    }

    protected function messages()
    {
        return [
            // … your custom messages …
        ];
    }

    public function mount($eventId = null)
    {
        if ($eventId) {
            $this->eventId = $eventId;
            $this->event = Event::findOrFail($eventId);
            $this->title = $this->event->title;
            $this->description = $this->event->description;
            $this->event_date = $this->event->event_date;
            $this->tag = $this->event->tag;
            $this->article = $this->event->article;
            $this->is_highlighted = $this->event->is_highlighted;
        }
    }

    // sync thumbnail validation
    public function updatedThumbnail()
    {
        $this->validateOnly('thumbnail', ['thumbnail' => 'image|max:5120']);
        $this->debugInfo = "Thumbnail ready: " . $this->thumbnail->getClientOriginalName();
    }

    // handle any field updating (including article via listener)
    public function updated($field)
    {
        $this->validateOnly($field, $this->rules(), $this->messages());
    }

    // listener for Quill editor
    public function updateQuill($model, $html)
    {
        $this->$model = $html;
        $this->validateOnly($model, $this->rules(), $this->messages());
    }

    public function save()
    {
        $this->validate($this->rules(), $this->messages());

        try {
            if ($this->eventId) {
                // --- UPDATE ---
                $event = Event::findOrFail($this->eventId);

                // delete inline images from old article
                $this->deleteImagesInContent($event->article);

                // process new article (base64 → storage, swap src)
                $cleanHtml = $this->processQuillContent($this->article);
                $event->article = $cleanHtml;

                // other fields
                $event->title = $this->title;
                $event->description = $this->description;
                $event->event_date = $this->event_date;
                $event->tag = $this->tag;
                $event->is_highlighted = $this->is_highlighted;

                // thumbnail replacement
                if ($this->thumbnail) {
                    if ($event->thumbnail) {
                        Storage::disk('public')->delete($event->thumbnail);
                    }
                    $filename = uniqid() . '.' . $this->thumbnail->extension();
                    $this->thumbnail->storeAs('uploads/events', $filename, 'public');
                    $event->thumbnail = 'uploads/events/' . $filename;
                }

                $event->save();
                session()->flash('success', 'Event updated successfully!');

            } else {
                // --- CREATE ---
                $event = new Event();
                $event->title = $this->title;
                $event->description = $this->description;
                $event->event_date = $this->event_date;
                $event->tag = $this->tag;
                $event->is_highlighted = $this->is_highlighted;

                // process article
                $event->article = $this->processQuillContent($this->article);

                // handle thumbnail
                $filename = uniqid() . '.' . $this->thumbnail->extension();
                $this->thumbnail->storeAs('uploads/events', $filename, 'public');
                $event->thumbnail = 'uploads/events/' . $filename;

                $event->save();
                session()->flash('success', 'Event added successfully!');
            }

            return redirect()->route('admin.events');
        } catch (\Exception $e) {
            Log::error('Event save error: ' . $e->getMessage());
            session()->flash('error', 'Error saving event: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.events.event-form');
    }

    /*** Helpers ***/

    protected function processQuillContent(string $html): string
    {
        Storage::disk('public')->makeDirectory('rte-images');

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        foreach (iterator_to_array($dom->getElementsByTagName('img')) as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('#^data:image/([^;]+);base64,(.+)$#', $src, $m)) {
                $ext = $m[1];
                $data = base64_decode($m[2]);
                $filename = 'rte-images/' . uniqid() . '.' . $ext;
                Storage::disk('public')->put($filename, $data);
                $img->setAttribute('src', asset("storage/{$filename}"));
            }
        }

        return $dom->saveHTML();
    }

    protected function deleteImagesInContent(string $html): void
    {
        preg_match_all('/<img[^>]+src="([^"]+)"/i', $html, $matches);
        foreach ($matches[1] as $url) {
            if (strpos($url, '/storage/rte-images/') !== false) {
                $path = str_replace('/storage/', '', parse_url($url, PHP_URL_PATH));
                Storage::disk('public')->delete($path);
            }
        }
    }
}
