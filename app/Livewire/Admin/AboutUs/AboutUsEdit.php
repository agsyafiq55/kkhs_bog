<?php

namespace App\Livewire\Admin\AboutUs;

use Livewire\Component;
use App\Models\AboutUs;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class AboutUsEdit extends Component
{
    use WithFileUploads;

    public $aboutUsId;
    public $aboutUs;
    public $chairman_speech;
    public $newOrganizationPhoto;
    public $newChairmanPhoto;
    public $debugInfo = '';

    // Add this method to handle file uploads directly
    public function updatedNewOrganizationPhoto()
    {
        $this->validate([
            'newOrganizationPhoto' => 'image|max:5120', // 5MB max
        ]);
        
        $this->debugInfo = "Organization photo uploaded: " . $this->newOrganizationPhoto->getClientOriginalName();
    }

    public function updatedNewChairmanPhoto()
    {
        $this->validate([
            'newChairmanPhoto' => 'image|max:5120', // 5MB max
        ]);
        
        $this->debugInfo = "Chairman photo uploaded: " . $this->newChairmanPhoto->getClientOriginalName();
    }

    // Change from property to method for dynamic rules
    protected function rules()
    {
        $rules = [
            'chairman_speech' => 'required|string',
        ];

        // Only require photos for new records
        if (!$this->aboutUsId) {
            $rules['newOrganizationPhoto'] = 'required|image|max:5120';
            $rules['newChairmanPhoto'] = 'required|image|max:5120';
        } else {
            $rules['newOrganizationPhoto'] = 'nullable|image|max:5120';
            $rules['newChairmanPhoto'] = 'nullable|image|max:5120';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'chairman_speech.required' => 'The chairman speech field is required.',
            'newOrganizationPhoto.required' => 'Please select an organization photo to upload.',
            'newChairmanPhoto.required' => 'Please select a chairman photo to upload.',
            'newOrganizationPhoto.image' => 'The file must be an image (jpeg, png, bmp, gif, svg, or webp).',
            'newChairmanPhoto.image' => 'The file must be an image (jpeg, png, bmp, gif, svg, or webp).',
            'newOrganizationPhoto.max' => 'The image size must not exceed 5MB.',
            'newChairmanPhoto.max' => 'The image size must not exceed 5MB.',
        ];
    }

    public function mount()
    {
        $this->aboutUs = AboutUs::first();
        
        if ($this->aboutUs) {
            $this->aboutUsId = $this->aboutUs->id;
            $this->chairman_speech = $this->aboutUs->chairman_speech;
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
            // Validate
            $this->validate($this->rules(), $this->messages());

            if ($this->aboutUsId) {
                // Update existing about us
                $aboutUs = AboutUs::findOrFail($this->aboutUsId);
            } else {
                // Create new about us
                $aboutUs = new AboutUs();
            }
            
            $aboutUs->chairman_speech = $this->chairman_speech;

            if ($this->newOrganizationPhoto) {
                // Store the organization photo as base64
                $aboutUs->organization_photo = base64_encode(file_get_contents($this->newOrganizationPhoto->getRealPath()));
            }

            if ($this->newChairmanPhoto) {
                // Store the chairman photo as base64
                $aboutUs->chairman_photo = base64_encode(file_get_contents($this->newChairmanPhoto->getRealPath()));
            }

            $aboutUs->save();
            
            $action = $this->aboutUsId ? 'updated' : 'created';
            session()->flash('message', "About Us information {$action} successfully!");

            return redirect()->route('admin.aboutus');
        } catch (\Exception $e) {
            // Log error
            Log::error('About Us save error: ' . $e->getMessage());
            
            // Update debug info
            $this->debugInfo .= "\nError: " . $e->getMessage();
            
            // Flash error message
            session()->flash('error', 'Error saving About Us: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.aboutus.aboutus-edit', [
            'debugInfo' => $this->debugInfo
        ]);
    }
}