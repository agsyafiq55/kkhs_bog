<?php

namespace App\Livewire\Admin\AboutUs;

use Livewire\Component;
use App\Models\AboutUs;

class AboutUsList extends Component
{
    public $aboutUsId;
    public $aboutUsData;
    public $selectedYear = ''; // Year filter property
    public $availableYears = []; // To store all available years

    public function mount()
    {
        $this->loadAvailableYears();
        
        // Set default year to latest year if available
        if (!empty($this->availableYears)) {
            $this->selectedYear = $this->availableYears[0]; // First item is the latest year
        }
        
        $this->loadAboutUsData();
    }
    
    // Load all unique years from the aboutus table
    public function loadAvailableYears()
    {
        $this->availableYears = AboutUs::select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
    }
    
    public function loadAboutUsData()
    {
        $query = AboutUs::query();
        
        // Apply year filter if selected
        if ($this->selectedYear !== '') {
            $query->where('year', $this->selectedYear);
        }
        
        $this->aboutUsData = $query->first();
    }
    
    // Handle year filter changes
    public function updatedSelectedYear()
    {
        $this->loadAboutUsData();
    }

    public function render()
    {
        return view('livewire.admin.aboutus.aboutus-list', [
            'aboutUsData' => $this->aboutUsData,
        ]);
    }

    public function deleteAboutUs($aboutUsId)
    {
        try {
            $aboutUs = AboutUs::findOrFail($aboutUsId);
            $result = $aboutUs->delete();
            
            if ($result) {
                $this->loadAvailableYears();
                $this->loadAboutUsData();
                session()->flash('message', 'About Us information deleted successfully!');
            } else {
                throw new \Exception('Failed to delete About Us information');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting About Us information: ' . $e->getMessage());
        }
    }
}