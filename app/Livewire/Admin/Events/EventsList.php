<?php

namespace App\Livewire\Admin\Events;

use Livewire\Component;
use App\Models\Event;

class EventsList extends Component
{
    public $events = [];
    public $debugInfo = '';

    public function mount()
    {
        $this->loadEvents();
    }

    // Load events sorted by creation date.
    public function loadEvents()
    {
        $this->events = Event::orderBy('created_at', 'desc')->get()->map(function ($event) {
            $event->has_thumbnail = !empty($event->thumbnail);
            return $event;
        });
    }

    // Delete an event.
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
            'events'    => $this->events,
            'debugInfo' => $this->debugInfo,
        ]);
    }

    public function redirectToShow($eventId)
    {
        return redirect()->route('admin.events.show', $eventId);
    }
}
