<?php

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use App\Models\Gallery;
use Livewire\WithFileUploads;

class GalleryEdit extends Component
{
    use WithFileUploads;

    public $galleryId;
    public $gallery;
    public $img_name;
    public $image;
    public $description;
    public $category;
    public $newImage;

    protected $rules = [
        'img_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category' => 'required|string|max:255',
        'newImage' => 'nullable|image|max:2048',
    ];

    public function mount($galleryId = null)
    {
        if ($galleryId) {
            $this->galleryId = $galleryId;
            $this->gallery = Gallery::findOrFail($galleryId);
            $this->img_name = $this->gallery->img_name;
            $this->description = $this->gallery->description;
            $this->category = $this->gallery->category;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->galleryId) {
            // Update existing gallery
            $gallery = Gallery::findOrFail($this->galleryId);
            
            $data = [
                'img_name' => $this->img_name,
                'description' => $this->description,
                'category' => $this->category,
            ];

            if ($this->newImage) {
                // Convert the uploaded image to base64
                $imageData = base64_encode(file_get_contents($this->newImage->getRealPath()));
                $data['image'] = $imageData;
            }

            $gallery->update($data);
            session()->flash('message', 'Gallery image updated successfully!');
        } else {
            // Create new gallery
            $this->validate([
                'newImage' => 'required|image|max:2048',
            ]);

            // Convert the uploaded image to base64
            $imageData = base64_encode(file_get_contents($this->newImage->getRealPath()));
            
            Gallery::create([
                'img_name' => $this->img_name,
                'image' => $imageData,
                'description' => $this->description,
                'category' => $this->category,
            ]);
            session()->flash('message', 'Gallery image added successfully!');
        }

        return redirect()->route('admin.gallery');
    }

    public function render()
    {
        return view('livewire.admin.gallery.gallery-edit');
    }
}