<?php

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use App\Models\Gallery;

class GalleryList extends Component
{
    public $galleries = [];
    public $debugInfo = '';
    public $search = ''; // Added search property

    protected $listeners = ['searchUpdated' => 'updateSearch']; // Listen for SearchBar updates

    public function mount()
    {
        $this->loadGalleries();
    }

    public function updateSearch($term)
    {
        $this->search = $term;
        $this->loadGalleries();
    }

    // Load galleries sorted by creation date.
    // public function loadGalleries()
    // {
    //     $this->galleries = Gallery::orderBy('created_at', 'desc')->get();
    // }

    public function loadGalleries()
    {
        $query = Gallery::orderBy('created_at', 'desc');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('img_name', 'like', "%{$this->search}%")
                    ->orWhere('category', 'like', "%{$this->search}%");
            });
        }

        $this->galleries = $query->get()->map(function ($galleries) {
            $galleries->has_image = !empty($galleries->image);
            return $galleries;
        });
    }

    // Delete a gallery item.
    public function delete($id)
    {
        try {
            Gallery::findOrFail($id)->delete();
            session()->flash('message', 'Gallery image deleted successfully!');
            $this->debugInfo = "Gallery image {$id} deleted successfully.";
            $this->loadGalleries();
        } catch (\Exception $e) {
            $this->debugInfo = 'Error deleting gallery image: ' . $e->getMessage();
            session()->flash('error', 'Error deleting gallery image: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.gallery.gallery-list', [
            'galleries' => $this->galleries,
            'debugInfo' => $this->debugInfo,
        ]);
    }

    public function redirectToShow($galleryId)
    {
        return redirect()->route('admin.gallery.show', $galleryId);
    }
    
    // Handle the edit button click
    public function edit($galleryId)
    {
        return redirect()->route('admin.gallery.edit', $galleryId);
    }
}