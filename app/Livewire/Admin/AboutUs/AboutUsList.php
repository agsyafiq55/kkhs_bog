<?php

namespace App\Livewire\Admin\AboutUs;

use Livewire\Component;
use App\Models\AboutUs;

class AboutUsList extends Component
{
    public $aboutUs;
    public $debugInfo = '';

    public function mount()
    {
        $this->loadAboutUs();
    }

    // Load about us information
    public function loadAboutUs()
    {
        $this->aboutUs = AboutUs::first();
    }

    public function render()
    {
        return view('livewire.admin.aboutus.aboutus-list', [
            'aboutUs' => $this->aboutUs,
            'debugInfo' => $this->debugInfo,
        ]);
    }
    
    // Handle the edit button click
    public function edit()
    {
        return redirect()->route('admin.aboutus.edit');
    }
}