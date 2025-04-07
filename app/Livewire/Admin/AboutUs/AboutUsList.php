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
        $this->members = Member::orderBy('position')->get();
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