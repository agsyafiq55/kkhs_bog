<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Gallery;

class GalleryFilter extends Component
{
    public $selectedCategory = null;
    public $categories = [];
    public $images = [];

    public function mount($category = null)
    {
        $this->selectedCategory = $category;
        // Get all unique categories from images
        $this->categories = Gallery::distinct('category')->pluck('category')->filter()->values()->toArray();
        $this->loadImages();
    }

    public function setCategory($category = null)
    {
        $this->selectedCategory = $category;
        $this->loadImages();
    }

    private function loadImages()
    {
        $query = Gallery::query();
        
        if ($this->selectedCategory) {
            $query->where('category', $this->selectedCategory);
        }
        
        $this->images = $query->get();
    }

    public function render()
    {
        return view('livewire.gallery.gallery-filter');
    }
}
