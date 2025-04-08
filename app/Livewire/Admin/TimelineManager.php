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
    public $title;
    public $description;
    public $description_zh;
    public $side = 'left';
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_zh' => 'nullable|string',
        ]);

        if ($this->editingCardId) {
            $card = TimelineCard::find($this->editingCardId);
            $card->update([
                'year' => $this->year,
                'title' => $this->title,
                'description' => $this->description,
                'description_zh' => $this->description_zh,
                'side' => $this->side,
            ]);
        } else {
            $maxPosition = TimelineCard::max('position') ?? 0;

            TimelineCard::create([
                'year' => $this->year,
                'title' => $this->title,
                'description' => $this->description,
                'description_zh' => $this->description_zh,
                'side' => $this->side,
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
        $this->title = $card->title;
        $this->description = $card->description;
        $this->description_zh = $card->description_zh;
        $this->side = $card->side;
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
        $this->title = '';
        $this->description = '';
        $this->description_zh = '';
        $this->side = 'left';
    }

    public function render()
    {
        return view('livewire.admin.timeline-manager');
    }
}
