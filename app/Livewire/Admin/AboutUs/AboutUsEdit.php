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

    public function save()
    {
        try {
            $this->validate($this->rules(), $this->messages());

            if ($this->aboutUsId) {
                $aboutUs = AboutUs::findOrFail($this->aboutUsId);
            } else {
                $aboutUs = new AboutUs();
            }
            
            $aboutUs->year = $this->year;
            $aboutUs->chairman_speech = $this->chairman_speech;

            if ($this->newOrganizationPhoto) {
                $aboutUs->organization_photo = base64_encode(file_get_contents($this->newOrganizationPhoto->getRealPath()));
            }

            if ($this->newChairmanPhoto) {
                $aboutUs->chairman_photo = base64_encode(file_get_contents($this->newChairmanPhoto->getRealPath()));
            }

            $aboutUs->save();
            
            $action = $this->aboutUsId ? 'updated' : 'created';
            session()->flash('message', "About Us information for year {$this->year} {$action} successfully!");

            return redirect()->route('admin.aboutus');
        } catch (\Exception $e) {
            Log::error('About Us save error: ' . $e->getMessage());
            $this->debugInfo .= "\nError: " . $e->getMessage();
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