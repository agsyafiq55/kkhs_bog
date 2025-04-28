<?php

namespace App\Livewire\Admin\AboutUs;

use Livewire\Component;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Storage;

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

    public function deleteAboutUs($id)
    {
        try {
            $aboutUs = AboutUs::findOrFail($id);
    
            // Delete organization photo
            if ($aboutUs->organization_photo) {
                $orgPath = str_replace('public/', '', $aboutUs->organization_photo);
                if (Storage::disk('public')->exists($orgPath)) {
                    Storage::disk('public')->delete($orgPath);
                }
            }
    
            // Delete chairman photo
            if ($aboutUs->chairman_photo) {
                $chairPath = str_replace('public/', '', $aboutUs->chairman_photo);
                if (Storage::disk('public')->exists($chairPath)) {
                    Storage::disk('public')->delete($chairPath);
                }
            }
    
            $aboutUs->delete();
            session()->flash('success', 'About Us information deleted successfully.');
            $this->loadAboutUsData();
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting about us information: ' . $e->getMessage());
        }
    }
}