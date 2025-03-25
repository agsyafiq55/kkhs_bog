<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class ManageEvents extends Component
{
    use WithFileUploads;

    // Form fields
    public $title = '';
    public $description = '';
    public $article = '';
    public $event_date = '';
    public $thumbnail = null;
    public $tag = '';
    public $eventId = null;
    
    // For debugging
    public $debugInfo = '';

    // Define validation rules as a property for better reuse
    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'article' => 'required|string',
            'event_date' => 'required|date',
            'thumbnail' => $this->eventId ? 'nullable|image|max:5120' : 'required|image|max:5120', // 5MB
            'tag' => 'required|string|max:100',
        ];
    }

    // Custom validation messages
    protected function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'article.required' => 'The article field is required.',
            'event_date.required' => 'The event date field is required.',
            'thumbnail.required' => 'Please select a thumbnail image.',
            'thumbnail.image' => 'The file must be an image (jpeg, png, bmp, gif, svg, or webp).',
            'thumbnail.max' => 'The image size must not exceed 5MB.',
            'tag.required' => 'The tag field is required.',
        ];
    }

    public function updated($propertyName)
    {
        // Validate fields as they're updated
        $this->validateOnly($propertyName, $this->rules(), $this->messages());
    }

    public function save()
    {
        try {
            // Debug info
            $this->debugInfo = 'Starting save process...';
            
            // Validate all fields at once
            $validated = $this->validate($this->rules(), $this->messages());
            $this->debugInfo .= ' Validation passed.';
            
            // Prepare data array without thumbnail
            $data = [
                'title' => $this->title,
                'description' => $this->description,
                'article' => $this->article,
                'event_date' => $this->event_date,
                'tag' => $this->tag,
            ];
            
            // Process thumbnail if it exists
            if ($this->thumbnail) {
                $this->debugInfo .= ' Processing thumbnail...';
                
                try {
                    // Get path and read the file
                    $imagePath = $this->thumbnail->getRealPath();
                    $this->debugInfo .= ' Image path found.';
                    
                    $imageContent = file_get_contents($imagePath);
                    if ($imageContent !== false) {
                        $data['thumbnail'] = $imageContent;
                        $this->debugInfo .= ' Image content read successfully: ' . strlen($imageContent) . ' bytes.';
                    } else {
                        $this->debugInfo .= ' Failed to read image content.';
                    }
                } catch (\Exception $e) {
                    $this->debugInfo .= ' Error processing image: ' . $e->getMessage();
                    Log::error('Thumbnail processing error', ['error' => $e->getMessage()]);
                }
            }
            
            // Create or update the event
            if ($this->eventId) {
                $event = Event::find($this->eventId);
                
                // Keep existing thumbnail if no new one provided
                if (!$this->thumbnail && $event) {
                    unset($data['thumbnail']);
                    $this->debugInfo .= ' Keeping existing thumbnail.';
                }
                
                $event->update($data);
                $this->debugInfo .= ' Event updated successfully.';
                session()->flash('message', 'Event updated successfully!');
            } else {
                $event = Event::create($data);
                $this->debugInfo .= ' Event created successfully with ID: ' . $event->id;
                session()->flash('message', 'Event created successfully!');
            }
            
            // Check if thumbnail was saved correctly
            if (isset($event) && $event->id) {
                $savedEvent = Event::find($event->id);
                if ($savedEvent && $this->thumbnail) {
                    $thumbExists = !empty($savedEvent->thumbnail);
                    $thumbSize = $thumbExists ? strlen($savedEvent->thumbnail) : 0;
                    $this->debugInfo .= " Thumbnail saved: " . ($thumbExists ? 'Yes' : 'No') . 
                                      ". Size: {$thumbSize} bytes.";
                }
            }
            
            // Reset form fields
            $this->reset(['title', 'description', 'article', 'event_date', 'thumbnail', 'tag', 'eventId']);
            $this->resetValidation();
            
        } catch (\Exception $e) {
            $this->debugInfo = 'Error: ' . $e->getMessage();
            Log::error('Event save error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            session()->flash('error', 'Error saving event: ' . $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        try {
            $event = Event::findOrFail($id);
            $this->eventId = $event->id;
            $this->title = $event->title;
            $this->description = $event->description;
            $this->article = $event->article;
            $this->event_date = $event->event_date;
            $this->tag = $event->tag;
            // Note: We don't set $this->thumbnail because it expects a fresh upload
            
            $hasThumb = !empty($event->thumbnail);
            $thumbSize = $hasThumb ? strlen($event->thumbnail) : 0;
            $this->debugInfo = "Editing event {$id}. Has thumbnail: " . ($hasThumb ? 'Yes' : 'No') . 
                             ". Thumbnail size: {$thumbSize} bytes.";
        } catch (\Exception $e) {
            $this->debugInfo = 'Error editing event: ' . $e->getMessage();
            session()->flash('error', 'Error editing event: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Event::findOrFail($id)->delete();
            session()->flash('message', 'Event deleted successfully!');
            $this->debugInfo = "Event {$id} deleted successfully.";
        } catch (\Exception $e) {
            $this->debugInfo = 'Error deleting event: ' . $e->getMessage();
            session()->flash('error', 'Error deleting event: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $events = Event::orderBy('created_at', 'desc')->get()->map(function($event) {
            // Add a property to indicate if thumbnail exists
            $event->has_thumbnail = !empty($event->thumbnail);
            return $event;
        });
        
        return view('livewire.admin.manage-events', [
            'events' => $events,
            'debugInfo' => $this->debugInfo,
        ]);
    }
}