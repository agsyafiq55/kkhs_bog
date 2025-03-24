<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event;

class ManageEvents extends Component
{
    use WithFileUploads;

    public $title, $description, $article, $event_date, $thumbnail, $tag;
    public $eventId;

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'article' => 'required|string',
            'event_date' => 'required|date',
            'thumbnail' => 'nullable|image|max:1024', // 1MB max
            'tag' => 'required|string|max:100',
        ]);

        if ($this->thumbnail) {
            $validated['thumbnail'] = $this->thumbnail->store('thumbnails', 'public');
        }

        if ($this->eventId) {
            Event::find($this->eventId)->update($validated);
        } else {
            Event::create($validated);
        }

        $this->reset();
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $this->eventId = $event->id;
        $this->title = $event->title;
        $this->description = $event->description;
        $this->article = $event->article;
        $this->event_date = $event->event_date;
        $this->tag = $event->tag;
    }

    public function delete($id)
    {
        Event::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.manage-events', [
            'events' => Event::all(),
        ]);
    }
}
