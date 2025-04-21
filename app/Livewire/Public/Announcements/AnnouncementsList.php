<?php

namespace App\Livewire\Public\Announcements;

use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithPagination;

class AnnouncementsList extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Announcement::orderBy('published_at', 'desc');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('content', 'like', "%{$this->search}%");
            });
        }

        return view('livewire.public.announcements.announcements-list', [
            'announcements' => $query->paginate(9)
        ]);
    }
}