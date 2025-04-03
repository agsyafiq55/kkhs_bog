<?php

namespace App\Livewire\Admin\Events;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventForm extends Component
{
    use WithFileUploads;

    // Form fields
    public $eventId = null;
    public $title = '';
    public $description = '';
    public $article = '';
    public $event_date = '';
    public $thumbnail = null;
    public $tag = '';

    // For debugging
    public $debugInfo = '';

    // Validation rules
    protected function rules()
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'article'     => 'required|string',
            'event_date'  => 'required|date',
            'thumbnail'   => $this->eventId ? 'nullable|image|max:5120' : 'required|image|max:5120',
            'tag'         => 'required|string|max:100',
        ];
    }

    // Custom validation messages
    protected function messages()
    {
        return [
            'title.required'       => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'article.required'     => 'The article field is required.',
            'event_date.required'  => 'The event date field is required.',
            'thumbnail.required'   => 'Please select a thumbnail image.',
            'thumbnail.image'      => 'The file must be an image (jpeg, png, bmp, gif, svg, or webp).',
            'thumbnail.max'        => 'The image size must not exceed 5MB.',
            'tag.required'         => 'The tag field is required.',
        ];
    }

    /**
     * When the component is mounted, check if an eventId is passed.
     * If so, load its data for editing.
     */
    public function mount($eventId = null)
    {
        if ($eventId) {
            $event = Event::findOrFail($eventId);
            $this->eventId    = $event->id;
            $this->title      = $event->title;
            $this->description= $event->description;
            $this->article    = $event->article;
            $this->event_date = $event->event_date;
            $this->tag        = $event->tag;
            // Note: We don't prefill the thumbnail.
        }
    }

    // Validate fields as they are updated.
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules(), $this->messages());
    }

    // Save (create or update) event.
    public function save()
    {
        try {
            // Simplified debug info
            $this->debugInfo = "Thumbnail type: " . (is_object($this->thumbnail) ? get_class($this->thumbnail) : gettype($this->thumbnail));
            
            // Validate the form data
            $this->validate($this->rules(), $this->messages());
            
            // Create or update the event
            $event = $this->eventId ? Event::find($this->eventId) : new Event();
            $event->title = $this->title;
            $event->description = $this->description;
            $event->event_date = $this->event_date;
            $event->tag = $this->tag;
            $event->article = $this->article;
            
            // Simplified thumbnail handling
            if ($this->thumbnail) {
                Log::info('Thumbnail object type: ' . gettype($this->thumbnail));
                
                if (is_object($this->thumbnail) && method_exists($this->thumbnail, 'getClientOriginalName')) {
                    Log::info('Thumbnail file name: ' . $this->thumbnail->getClientOriginalName());
                    Log::info('Thumbnail file size: ' . $this->thumbnail->getSize());
                    
                    // Store the raw file contents
                    $event->thumbnail = file_get_contents($this->thumbnail->getRealPath());
                    $this->debugInfo .= "\nThumbnail processed successfully";
                } else {
                    Log::warning('Thumbnail is not a valid file upload object');
                    $this->debugInfo .= "\nThumbnail is not a valid file upload object";
                }
            } elseif (!$this->eventId) {
                // Only log warning if this is a new event
                Log::warning('No thumbnail provided');
                $this->debugInfo .= "\nNo thumbnail provided";
            }
            
            // Save the event
            $event->save();
            Log::info('Event saved successfully with ID: ' . $event->id);
            
            // Flash success message
            session()->flash('success', $this->eventId ? 'Event updated successfully!' : 'Event created successfully!');
            
            // Redirect to events list
            return redirect()->route('admin.events');
        } catch (\Exception $e) {
            // Log error
            Log::error('Event save error: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
            
            // Update debug info
            $this->debugInfo .= "\nError: " . $e->getMessage();
            
            // Flash error message
            session()->flash('error', 'Error saving event: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.events.event-form', [
            'debugInfo' => $this->debugInfo,
        ]);
    }
}
