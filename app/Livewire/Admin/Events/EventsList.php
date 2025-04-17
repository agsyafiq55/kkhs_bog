<?php

namespace App\Livewire\Admin\Events;

use Livewire\Component;
use App\Models\Event;

class EventsList extends Component
{
    public $events = [];
    public $debugInfo = '';
    public $search = ''; // Added search property

    protected $listeners = ['searchUpdated' => 'updateSearch']; // Listen for SearchBar updates

    public function mount()
    {
        $this->loadEvents();
    }

    public function updateSearch($term)
    {
        $this->search = $term;
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $query = Event::orderBy('created_at', 'desc');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('event_date', 'like', "%{$this->search}%");
            });
        }

        $this->events = $query->get()->map(function ($event) {
            $event->has_thumbnail = !empty($event->thumbnail);
            return $event;
        });
    }


    public function delete($id)
    {
        try {
            Event::findOrFail($id)->delete();
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
