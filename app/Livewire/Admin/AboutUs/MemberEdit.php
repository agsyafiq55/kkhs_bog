<?php

namespace App\Livewire\Admin\AboutUs;

use Livewire\Component;
use App\Models\Member;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class MemberEdit extends Component
{
    use WithFileUploads;
    public $memberId;
    public $member;
    public $member_name;
    public $position;
    public $newPhoto;
    public $debugInfo = '';

    // Add this method to handle file uploads directly
    public function updatedNewPhoto()
    {
        $this->validate([
            'newPhoto' => 'image|max:5120', // 5MB max
        ]);
        
        $this->debugInfo = "Member photo uploaded: " . $this->newPhoto->getClientOriginalName();
    }

    // Change from property to method for dynamic rules
    protected function rules()
    {
        $rules = [
            'member_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ];

        // Only require photos for new records
        if (!$this->memberId) {
            $rules['newPhoto'] = 'required|image|max:5120';
        } else {
            $rules['newPhoto'] = 'nullable|image|max:5120';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'member_name.required' => 'The member name field is required.',
            'position.required' => 'The position field is required.',
            'newPhoto.required' => 'Please select a member photo to upload.',
            'newPhoto.image' => 'The file must be an image (jpeg, png, bmp, gif, svg, or webp).',
            'newPhoto.max' => 'The image size must not exceed 5MB.',
        ];
    }

    public function mount($memberId = null)
    {
        if ($memberId) {
            $this->memberId = $memberId;
            $this->member = Member::findOrFail($memberId);
            $this->member_name = $this->member->member_name;
            $this->position = $this->member->position;
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

            if ($this->memberId) {
                // Update existing member
                $member = Member::findOrFail($this->memberId);
            } else {
                // Create new member
                $member = new Member();
            }
            
            $member->member_name = $this->member_name;
            $member->position = $this->position;

            if ($this->newPhoto) {
                // Store the photo as base64
                $member->photo = base64_encode(file_get_contents($this->newPhoto->getRealPath()));
            }

            $member->save();
            
            $action = $this->memberId ? 'updated' : 'created';
            session()->flash('message', "Member '{$this->member_name}' {$action} successfully!");

            return redirect()->route('admin.aboutus');
        } catch (\Exception $e) {
            // Log error
            Log::error('Member save error: ' . $e->getMessage());
            
            // Update debug info
            $this->debugInfo .= "\nError: " . $e->getMessage();
            
            // Flash error message
            session()->flash('error', 'Error saving Member: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.aboutus.members-edit', [
            'debugInfo' => $this->debugInfo
        ]);
    }

}