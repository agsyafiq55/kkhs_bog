<?php

namespace App\Livewire\Admin\Announcements;

use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AnnouncementForm extends Component
{
    use WithFileUploads;

    public $announcementId;
    public $title;
    public $content;
    public $image;
    public $currentImage;
    public $isEdit = false;
    public $publish_start;
    public $publish_end;
    public $publishRange = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|max:2048', // 2MB Max
        'publish_start' => 'nullable|date',
        'publish_end' => 'nullable|date|after_or_equal:publish_start',
    ];

    public function mount($announcementId = null)
    {
        if ($announcementId) {
            $this->announcementId = $announcementId;
            $this->isEdit = true;
            $this->loadAnnouncement();
        }
    }

    public function loadAnnouncement()
    {
        try {
            $announcement = Announcement::findOrFail($this->announcementId);
            $this->title = $announcement->title;
            $this->content = $announcement->content;
            $this->currentImage = $announcement->image;
            $this->publish_start = $announcement->publish_start ? $announcement->publish_start->format('Y-m-d') : null;
            $this->publish_end = $announcement->publish_end ? $announcement->publish_end->format('Y-m-d') : null;
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading announcement: ' . $e->getMessage());
            return redirect()->route('admin.announcements');
        }
    }

    public function save()
    {
        // Validate the form data
        $validatedData = $this->validate();

        try {
            // Prepare the data for saving
            $data = [
                'title' => $this->title,
                'content' => $this->content,
                'publish_start' => $this->publish_start,
                'publish_end' => $this->publish_end,
            ];

            // Handle image upload
            if ($this->image) {
                // Convert image to base64
                $imageData = base64_encode(file_get_contents($this->image->getRealPath()));
                $data['image'] = $imageData;
            } elseif (!$this->isEdit) {
                // If it's a new announcement, image is required
                $this->validate([
                    'image' => 'required|image|max:2048',
                ]);
            }

            if ($this->isEdit) {
                // Update existing announcement
                $announcement = Announcement::findOrFail($this->announcementId);
                
                // Only update image if a new one is uploaded
                if (!isset($data['image'])) {
                    unset($data['image']);
                }
                
                $announcement->update($data);
                session()->flash('message', 'Announcement updated successfully!');
            } else {
                // Create new announcement with current timestamp for published_at
                $data['published_at'] = Carbon::now();
                Announcement::create($data);
                session()->flash('message', 'Announcement created successfully!');
            }

            return redirect()->route('admin.announcements');
        } catch (\Exception $e) {
            Log::error('Error saving announcement: ' . $e->getMessage());
            session()->flash('error', 'Error saving announcement: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.announcements.announcement-form');
    }

    // Add this method to handle the date range updates
    public function updatedPublishRange($value)
    {
        if (is_array($value) && isset($value['start']) && isset($value['end'])) {
            $this->publish_start = $value['start'];
            $this->publish_end = $value['end'];
        } else {
            $this->publish_start = null;
            $this->publish_end = null;
        }
    }
}