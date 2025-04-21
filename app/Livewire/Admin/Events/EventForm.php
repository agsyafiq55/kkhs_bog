<?php

namespace App\Livewire\Admin\Events;

use Livewire\Component;
use App\Models\Event;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

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
    public $is_highlighted = 0; // Initialize with default value of 0
    public $debugInfo = '';

    // Add this method to handle file uploads directly
    public function updatedThumbnail()
    {
        $this->validate([
            'thumbnail' => 'image|max:5120', // 5MB max
        ]);
        
        $this->debugInfo = "Thumbnail uploaded: " . $this->thumbnail->getClientOriginalName();
    }

    // Change from property to method for dynamic rules
    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'tag' => 'required|string|max:255',
            'article' => 'required|string',
            'thumbnail' => $this->eventId ? 'nullable|image|max:5120' : 'required|image|max:5120',
            'is_highlighted' => 'boolean', // Add validation rule
        ];
    }

    protected function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'event_date.required' => 'The event date field is required.',
            'tag.required' => 'The tag field is required.',
            'article.required' => 'The article content is required.',
            'thumbnail.required' => 'Please select an image to upload.',
            'thumbnail.image' => 'The file must be an image (jpeg, png, bmp, gif, svg, or webp).',
            'thumbnail.max' => 'The image size must not exceed 5MB.',
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

    // Add validation on field update
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules(), $this->messages());
    }

    public function save()
    {
        try {
            // Validate
            $this->validate($this->rules(), $this->messages());

            if ($this->eventId) {
                // Update existing event
                $event = Event::findOrFail($this->eventId);
                $event->title = $this->title;
                $event->description = $this->description;
                $event->event_date = $this->event_date;
                $event->tag = $this->tag;
                $event->article = $this->article;
                $event->is_highlighted = $this->is_highlighted; 

                if ($this->thumbnail) {
                    // Convert image to base64 string for longtext storage
                    $imageData = base64_encode(file_get_contents($this->thumbnail->getRealPath()));
                    $event->thumbnail = $imageData;
                }

                $event->save();
                session()->flash('success', 'Event updated successfully!');
            } else {
                // Create new event
                $event = new Event();
                $event->title = $this->title;
                $event->description = $this->description;
                $event->event_date = $this->event_date;
                $event->tag = $this->tag;
                $event->article = $this->article;
                $event->is_highlighted = $this->is_highlighted; // Explicitly set the is_highlighted value
                
                // Convert image to base64 string for longtext storage
                $imageData = base64_encode(file_get_contents($this->thumbnail->getRealPath()));
                $event->thumbnail = $imageData;
                
                $event->save();
                session()->flash('success', 'Event added successfully!');
            }

            return redirect()->route('admin.events');
        } catch (\Exception $e) {
            // Log error
            Log::error('Event save error: ' . $e->getMessage());
            
            // Flash error message
            session()->flash('error', 'Error saving event: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.events.event-form');
    }
}
