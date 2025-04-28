<?php

namespace App\Livewire\Admin\Events;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventsList extends Component
{
    public $events = [];
    public $debugInfo = '';
    public $search = ''; // Added search property
    public $selectedTag = ''; // Added tag filter property
    public $availableTags = []; // To store all available tags

    protected $listeners = ['searchUpdated' => 'updateSearch']; // Listen for SearchBar updates

    public function mount()
    {
        $this->loadAvailableTags();
        $this->loadEvents();
    }

    // Load all unique tags from the events table
    public function loadAvailableTags()
    {
        $this->availableTags = Event::select('tag')
            ->distinct()
            ->orderBy('tag')
            ->pluck('tag')
            ->toArray();
    }

    public function updateSearch($term)
    {
        $this->search = $term;
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $query = Event::orderBy('is_highlighted', 'desc')
                      ->orderBy('created_at', 'desc');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('event_date', 'like', "%{$this->search}%");
            });
        }

        // Apply tag filter if selected
        if ($this->selectedTag !== '') {
            $query->where('tag', $this->selectedTag);
        }

        $this->events = $query->get()->map(function ($event) {
            $event->has_thumbnail = !empty($event->thumbnail);
            return $event;
        });
    }

    // Add method to handle tag filter changes
    public function updatedSelectedTag()
    {
        $this->loadEvents();
    }

    public function delete($id)
    {
        try {
            $event = Event::findOrFail($id);

            // Check if the event has a thumbnail and delete the image file from storage
            if ($event->thumbnail) {
                // Remove 'public/' prefix from the path if it's stored in the database as a relative path
                $imagePath = str_replace('public/', '', $event->thumbnail);

                // Check if the file exists before attempting to delete it
                if (Storage::disk('public')->exists($imagePath)) {
                    // Delete the image from storage
                    Storage::disk('public')->delete($imagePath);
                }
            }

            // Delete the event record
            $event->delete();
            
            session()->flash('message', 'Event deleted successfully!');
            $this->debugInfo = "Event {$id} deleted successfully.";
            $this->loadEvents();
        } catch (\Exception $e) {
            $this->debugInfo = 'Error deleting event: ' . $e->getMessage();
            session()->flash('error', 'Error deleting event: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.events.events-list', [
            'events' => $this->events,
            'debugInfo' => $this->debugInfo,
        ]);
    }

    public function redirectToShow($eventId)
    {
        return redirect()->route('admin.events.show', $eventId);
    }

    public function edit($eventId)
    {
        return redirect()->route('admin.events.edit', $eventId);
    }
}
