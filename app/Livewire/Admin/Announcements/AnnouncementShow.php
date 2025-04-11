<?php

namespace App\Livewire\Admin\Announcements;

use Livewire\Component;
use App\Models\Announcement;

class AnnouncementShow extends Component
{
    public $announcement;

    public function mount($announcementId)
    {
        $this->announcement = Announcement::findOrFail($announcementId);
    }

    public function render()
    {
        return view('livewire.admin.announcements.announcement-show', [
            'announcement' => $this->announcement,
        ]);
    }
}