<?php

namespace App\Livewire\Admin\AboutUs;

use Livewire\Component;
use App\Models\AboutUs;

class AboutUsList extends Component
{
    public $aboutUs;
    public $debugInfo = '';
    public $selectedYear = '';
    public $availableYears = [];

    public function mount()
    {
        $this->loadAvailableYears();
        $this->loadAboutUs();
    }

    public function loadAvailableYears()
    {
        $this->availableYears = AboutUs::select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        if (!$this->selectedYear && !empty($this->availableYears)) {
            $this->selectedYear = $this->availableYears[0];
        }
    }

    public function loadAboutUs()
    {
        $query = AboutUs::query();
        
        if ($this->selectedYear) {
            $query->where('year', $this->selectedYear);
        }

        $this->aboutUs = $query->first();
    }

    public function updatedSelectedYear()
    {
        $this->loadAboutUs();
    }

    public function render()
    {
        return view('livewire.admin.aboutus.aboutus-list', [
            'aboutUs' => $this->aboutUs,
            'debugInfo' => $this->debugInfo,
        ]);
    }
    
    public function edit()
    {
        return redirect()->route('admin.aboutus.edit');
    }
}