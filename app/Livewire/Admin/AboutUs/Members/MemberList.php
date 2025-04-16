<?php

namespace App\Livewire\Admin\AboutUs\Members;

use Livewire\Component;
use App\Models\Member;

class MemberList extends Component
{
    public $memberId;
    public $members;
    public $debugInfo = '';

    public function mount()
    {
        $this->loadMembers();
    }
    
    public function loadMembers()
    {
        $this->members = Member::orderByRaw("
            CASE position
                WHEN 'Chairman' THEN 1
                WHEN 'Vice Chairman I' THEN 2
                WHEN 'Vice Chairman II' THEN 3
                WHEN 'Secretary' THEN 4
                WHEN 'Treasurer' THEN 5
                WHEN 'Supervision' THEN 6
                WHEN 'Member of Board of Governor' THEN 7
                ELSE 8
            END
        ")->get();
    }

    public function render()
    {
        return view('livewire.admin.aboutus.members.members-list', [
            'members' => $this->members,
            'debugInfo' => $this->debugInfo,
        ]);
    }

    public function deleteMember($memberId)
    {
        try {
            $member = Member::findOrFail($memberId);
            $result = $member->delete();
            
            if ($result) {
                $this->loadMembers();
                session()->flash('message', 'Member deleted successfully!');
                $this->debugInfo = "Member {$memberId} deleted successfully.";
            } else {
                throw new \Exception('Failed to delete member');
            }
        } catch (\Exception $e) {
            $this->debugInfo = 'Error deleting member: ' . $e->getMessage();
            session()->flash('error', 'Error deleting member: ' . $e->getMessage());
        }
    }
}