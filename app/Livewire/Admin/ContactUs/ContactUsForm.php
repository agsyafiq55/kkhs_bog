<?php

namespace App\Livewire\Admin\ContactUs;

use Livewire\Component;
use App\Models\ContactUs;

class ContactUsForm extends Component
{
    public $contactUsId;
    public $address;
    public $email;
    public $phone_no1;
    public $phone_no2;
    public $maps_coordinate;

    public function mount($contactUsId = null)
    {
        if ($contactUsId) {
            $contactUs = ContactUs::findOrFail($contactUsId);
            $this->contactUsId = $contactUs->id;
            $this->address = $contactUs->address;
            $this->email = $contactUs->email;
            $this->phone_no1 = $contactUs->phone_no1;
            $this->phone_no2 = $contactUs->phone_no2;
            $this->maps_coordinate = $contactUs->maps_coordinate;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_no1' => 'required|string|max:15',
            'phone_no2' => 'nullable|string|max:15',
            'maps_coordinate' => 'nullable|string', // Removed max:255 constraint
        ]);

        ContactUs::updateOrCreate(
            ['id' => $this->contactUsId],
            $validatedData
        );

        session()->flash('success', 'Contact information saved successfully!');
        return redirect()->route('admin.contactus.display');
    }

    public function render()
    {
        return view('livewire.admin.contact-us.contact-us-form');
    }
}
