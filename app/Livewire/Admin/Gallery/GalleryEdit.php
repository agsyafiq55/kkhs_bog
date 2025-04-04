<?php

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use App\Models\Gallery;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

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
    public $debugInfo = '';

    // Add this method to handle file uploads directly
    public function updatedNewImage()
    {
        $this->validate([
            'newImage' => 'image|max:5120', // 5MB max
        ]);
        
        $this->debugInfo = "Image uploaded: " . $this->newImage->getClientOriginalName();
    }

    // Change from property to method for dynamic rules
    protected function rules()
    {
        return [
            'img_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'newImage' => $this->galleryId ? 'nullable|image|max:5120' : 'required|image|max:5120',
        ];
    }

    protected function messages()
    {
        return [
            'img_name.required' => 'The image name field is required.',
            'category.required' => 'The category field is required.',
            'newImage.required' => 'Please select an image to upload.',
            'newImage.image' => 'The file must be an image (jpeg, png, bmp, gif, svg, or webp).',
            'newImage.max' => 'The image size must not exceed 5MB.',
        ];
    }

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

    // Add validation on field update
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules(), $this->messages());
    }

    public function save()
    {
        try {
            // Debug info
            $this->debugInfo = "Image type: " . (is_object($this->newImage) ? get_class($this->newImage) : gettype($this->newImage));
            
            // Validate
            $this->validate([
                'img_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'required|string|max:255',
                'newImage' => $this->galleryId ? 'nullable|image|max:5120' : 'required|image|max:5120',
            ]);

            if ($this->galleryId) {
                // Update existing gallery
                $gallery = Gallery::findOrFail($this->galleryId);
                $gallery->img_name = $this->img_name;
                $gallery->description = $this->description;
                $gallery->category = $this->category;

                if ($this->newImage) {
                    // Store the image as base64
                    $gallery->image = base64_encode(file_get_contents($this->newImage->getRealPath()));
                }

                $gallery->save();
                session()->flash('message', 'Gallery image updated successfully!');
            } else {
                // Create new gallery
                $gallery = new Gallery();
                $gallery->img_name = $this->img_name;
                $gallery->description = $this->description;
                $gallery->category = $this->category;
                
                // Store the image as base64
                $gallery->image = base64_encode(file_get_contents($this->newImage->getRealPath()));
                
                $gallery->save();
                session()->flash('message', 'Gallery image added successfully!');
            }

            return redirect()->route('admin.gallery');
        } catch (\Exception $e) {
            // Log error
            Log::error('Gallery save error: ' . $e->getMessage());
            
            // Update debug info
            $this->debugInfo .= "\nError: " . $e->getMessage();
            
            // Flash error message
            session()->flash('error', 'Error saving gallery: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.gallery.gallery-edit', [
            'debugInfo' => $this->debugInfo
        ]);
    }
}