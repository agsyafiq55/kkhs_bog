<?php

namespace App\Livewire\Admin\AboutUs;

use Livewire\Component;
use App\Models\AboutUs;
use App\Models\Member;

class AboutUsList extends Component
{
    public $aboutUs;
    public $members;
    public $debugInfo = '';

    public function mount()
    {
        $this->loadAboutUs();
        $this->loadMembers();
    }

    // Load about us information
    public function loadAboutUs()
    {
        $this->aboutUs = AboutUs::first();
    }
    
    // Load members information
    public function loadMembers()
    {
        $this->members = Member::orderByRaw("
            CASE position
                WHEN 'Chairman' THEN 1
                WHEN 'Vice Chairman I' THEN 2
                WHEN 'Vice Chairman II' THEN 3
                WHEN 'Secretary' THEN 4
                WHEN 'Tresurer' THEN 5
                WHEN 'Supervision' THEN 6
                WHEN 'Member of Board of Governor' THEN 7
                ELSE 8
            END
        ")->get();
    }

    public function render()
    {
        return view('livewire.admin.aboutus.aboutus-list', [
            'aboutUs' => $this->aboutUs,
            'members' => $this->members,
            'debugInfo' => $this->debugInfo,
        ]);
    }
    
    // Handle the edit button click
    public function edit()
    {
        return redirect()->route('admin.aboutus.edit');
    }
    
    // Handle member deletion
    public function deleteMember($memberId)
    {
        try {
            $member = Member::findOrFail($memberId);
            $memberName = $member->member_name;
            $member->delete();
            
            session()->flash('message', "Member '{$memberName}' deleted successfully!");
            $this->loadMembers(); // Reload the members list
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting member: ' . $e->getMessage());
            $this->debugInfo .= "\nError: " . $e->getMessage();
        }
    }
}