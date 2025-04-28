<?php

namespace App\Livewire\Admin\AboutUs;

use Livewire\Component;
use App\Models\AboutUs;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AboutUsEdit extends Component
{
    use WithFileUploads;

    // Livewire Form
    public $aboutUsId;
    public $aboutUs;
    public $year;
    public $organization_photo;
    public $chairman_photo;
    public $chairman_speech;
    public $newOrganizationPhoto;
    public $newChairmanPhoto;
    public $debugInfo = '';

    protected function rules()
    {
        $rules = [
            'year' => 'required|string|max:9',
            'chairman_speech' => 'nullable|string',
        ];

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
            'year.required' => 'The year field is required.',
            'year.string' => 'The year must be a valid string.',
            'year.max' => 'The year cannot exceed 9 characters.',
            'newOrganizationPhoto.required' => 'Organization photo is required.',
            'newOrganizationPhoto.image' => 'Organization photo must be an image file.',
            'newOrganizationPhoto.max' => 'Organization photo must not exceed 5MB.',
            'newChairmanPhoto.required' => 'Chairman photo is required.',
            'newChairmanPhoto.image' => 'Chairman photo must be an image file.',
            'newChairmanPhoto.max' => 'Chairman photo must not exceed 5MB.',
        ];
    }

    public function mount($aboutUsId = null)
    {
        if ($aboutUsId) {
            $this->aboutUsId = $aboutUsId;
            $this->aboutUs = AboutUs::findOrFail($aboutUsId);
            $this->year = $this->aboutUs->year;
            $this->organization_photo = $this->aboutUs->organization_photo;
            $this->chairman_photo = $this->aboutUs->chairman_photo;
            $this->chairman_speech = $this->aboutUs->chairman_speech;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules(), $this->messages());
    }

    // Add this method to handle file uploads directly
    public function updatedNewOrganizationPhoto()
    {
        $this->validate([
            'newOrganizationPhoto' => 'image|max:5120', // 5MB max
        ]);
    }

    public function updatedNewChairmanPhoto()
    {
        $this->validate([
            'newChairmanPhoto' => 'image|max:5120', // 5MB max
        ]);
    }

    public function save()
    {
        $this->validate();
    
        try {
            if ($this->aboutUsId) {
                $aboutUs = AboutUs::findOrFail($this->aboutUsId);
                
                // Handle organization photo
                if ($this->newOrganizationPhoto) {
                    if ($aboutUs->organization_photo) {
                        Storage::disk('public')->delete($aboutUs->organization_photo);
                    }
                    $filename = uniqid() . '.' . $this->newOrganizationPhoto->getClientOriginalExtension();
                    $this->newOrganizationPhoto->storeAs('uploads/aboutus/organization_photo', $filename, 'public');
                    $aboutUs->organization_photo = 'uploads/aboutus/organization_photo/' . $filename;
                }
            
                // Handle chairman photo
                if ($this->newChairmanPhoto) {
                    if ($aboutUs->chairman_photo) {
                        Storage::disk('public')->delete($aboutUs->chairman_photo);
                    }
                    $filename = uniqid() . '.' . $this->newChairmanPhoto->getClientOriginalExtension();
                    $this->newChairmanPhoto->storeAs('uploads/aboutus/chairman_photo', $filename, 'public');
                    $aboutUs->chairman_photo = 'uploads/aboutus/chairman_photo/' . $filename;
                }

                $aboutUs->year = $this->year;
                $aboutUs->chairman_speech = $this->chairman_speech;
                $aboutUs->save();
            
                session()->flash('success', 'About Us information updated successfully.');
            } else {
                // Create new about us
                $aboutUs = new AboutUs();
                $aboutUs->year = $this->year;
                $aboutUs->chairman_speech = $this->chairman_speech;
            
                // Store organization photo
                $filename = uniqid() . '.' . $this->newOrganizationPhoto->getClientOriginalExtension();
                $this->newOrganizationPhoto->storeAs('uploads/aboutus/organization_photo', $filename, 'public');
                $aboutUs->organization_photo = 'uploads/aboutus/organization_photo/' . $filename;
            
                // Store chairman photo
                $filename = uniqid() . '.' . $this->newChairmanPhoto->getClientOriginalExtension();
                $this->newChairmanPhoto->storeAs('uploads/aboutus/chairman_photo', $filename, 'public');
                $aboutUs->chairman_photo = 'uploads/aboutus/chairman_photo/' . $filename;
            
                $aboutUs->save();
                session()->flash('success', 'About Us information created successfully.');
            }
        
            return redirect()->route('admin.aboutus');
        } catch (\Exception $e) {
            Log::error('Error saving about us: ' . $e->getMessage());
            session()->flash('error', 'Error saving about us information: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.aboutus.aboutus-edit', [
            'debugInfo' => $this->debugInfo
        ]);
    }
}