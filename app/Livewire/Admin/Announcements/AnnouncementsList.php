<?php

namespace App\Livewire\Admin\Announcements;

use Livewire\Component;
use App\Models\Announcement;

class AnnouncementsList extends Component
{
    public $announcements = [];
    public $debugInfo = '';
    public $search = ''; // Added search property

    protected $listeners = ['searchUpdated' => 'updateSearch']; // Listen for SearchBar updates

    public function mount()
    {
        $this->loadAnnouncements();
    }

    // Load announcements sorted by published_at date.

    public function loadAnnouncements()
    {
        $query = Announcement::orderBy('created_at', 'desc');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('content', 'like', "%{$this->search}%");
            });
        }

        $this->announcements = $query->get()->map(function ($announcements) {
            $announcements->has_image = !empty($announcements->image);
            return $announcements;
        });
    }

    // Delete an announcement.
    public function delete($id)
    {
        try {
            Announcement::findOrFail($id)->delete();
            session()->flash('message', 'Announcement deleted successfully!');
            $this->debugInfo = "Announcement {$id} deleted successfully.";
            $this->loadAnnouncements();
        } catch (\Exception $e) {
            $this->debugInfo = 'Error deleting announcement: ' . $e->getMessage();
            session()->flash('error', 'Error deleting announcement: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.announcements.announcements-list', [
            'announcements' => $this->announcements,
            'debugInfo' => $this->debugInfo,
        ]);
    }

    public function redirectToShow($announcementId)
    {
        return redirect()->route('admin.announcements.show', $announcementId);
    }
    
    public function edit($announcementId)
    {
        return redirect()->route('admin.announcements.edit', $announcementId);
    }
}