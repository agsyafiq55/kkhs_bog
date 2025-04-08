<?php

// app/Livewire/Admin/TimelineManager.php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\TimelineCard;
use Livewire\WithFileUploads;

class TimelineManager extends Component
{
    use WithFileUploads;

    public $cards;
    public $year;
    public $description;
    public $description_zh;
    public $editingCardId = null;

    public function mount()
    {
        $this->loadCards();
    }

    public function loadCards()
    {
        $this->cards = TimelineCard::orderBy('position')->get();
    }

    public function saveCard()
    {
        $this->validate([
            'year' => 'required|numeric',
            'description' => 'nullable|string',
            'description_zh' => 'nullable|string',
        ]);

        if ($this->editingCardId) {
            $card = TimelineCard::find($this->editingCardId);
            $card->update([
                'year' => $this->year,
                'description' => $this->description,
                'description_zh' => $this->description_zh,
            ]);
        } else {
            $maxPosition = TimelineCard::max('position') ?? 0;

            TimelineCard::create([
                'year' => $this->year,
                'description' => $this->description,
                'description_zh' => $this->description_zh,
                'position' => $maxPosition + 1,
            ]);
        }

        $this->resetForm();
        $this->loadCards();
    }

    public function editCard($id)
    {
        $card = TimelineCard::find($id);
        $this->editingCardId = $card->id;
        $this->year = $card->year;
        $this->description = $card->description;
        $this->description_zh = $card->description_zh;
    }

    public function deleteCard($id)
    {
        TimelineCard::destroy($id);
        $this->loadCards();
    }

    public function updateOrder($orderedIds)
    {
        foreach ($orderedIds as $position => $id) {
            TimelineCard::where('id', $id)->update(['position' => $position]);
        }

        $this->loadCards();
    }

    public function resetForm()
    {
        $this->editingCardId = null;
        $this->year = '';
        $this->description = '';
        $this->description_zh = '';
    }

    public function render()
    {
        return view('livewire.admin.timeline-manager');
    }
}
