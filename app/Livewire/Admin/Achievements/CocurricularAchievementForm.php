<?php

namespace App\Livewire\Admin\Achievements;

use App\Models\CocurricularAchievement;
use Livewire\Component;

class CocurricularAchievementForm extends Component
{
    public $cocurricularAchievement;
    public $eventTitle;
    public $category;
    public $placementType;
    public $studentCount;
    public $eventDate;
    public $description;
    public $isEdit = false;

    protected $rules = [
        'eventTitle' => 'required|string|max:255',
        'category' => 'required|string|max:100',
        'placementType' => 'required|string|max:100',
        'studentCount' => 'required|integer|min:1',
        'eventDate' => 'required|date',
        'description' => 'nullable|string',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->cocurricularAchievement = CocurricularAchievement::findOrFail($id);
            $this->eventTitle = $this->cocurricularAchievement->event_title;
            $this->category = $this->cocurricularAchievement->category;
            $this->placementType = $this->cocurricularAchievement->placement_type;
            $this->studentCount = $this->cocurricularAchievement->student_count;
            $this->eventDate = $this->cocurricularAchievement->event_date->format('Y-m-d');
            $this->description = $this->cocurricularAchievement->description;
            $this->isEdit = true;
        } else {
            $this->cocurricularAchievement = new CocurricularAchievement();
            $this->eventDate = now()->format('Y-m-d');
        }
    }

    public function save()
    {
        $this->validate();

        $this->cocurricularAchievement->event_title = $this->eventTitle;
        $this->cocurricularAchievement->category = $this->category;
        $this->cocurricularAchievement->placement_type = $this->placementType;
        $this->cocurricularAchievement->student_count = $this->studentCount;
        $this->cocurricularAchievement->event_date = $this->eventDate;
        $this->cocurricularAchievement->description = $this->description;
        $this->cocurricularAchievement->save();

        session()->flash('message', $this->isEdit ? 'Co-curricular achievement updated successfully.' : 'Co-curricular achievement created successfully.');
        return redirect()->route('admin.achievements.cocurricular.index');
    }

    public function render()
    {
        $categories = CocurricularAchievement::distinct()->pluck('category')->toArray();
        $placementTypes = CocurricularAchievement::distinct()->pluck('placement_type')->toArray();

        return view('livewire.admin.achievements.cocurricular-achievement-form', [
            'categories' => $categories,
            'placementTypes' => $placementTypes,
        ]);
    }
}