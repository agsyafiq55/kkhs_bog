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

    /**
     * Update the order of timeline cards
     */
    public function updateOrder(array $orderedIds)
    {
        // Loop through the ordered IDs and update the position
        foreach ($orderedIds as $index => $id) {
            // Find the card
            $card = TimelineCard::find($id);
            if ($card) {
                // Update the position (assuming you have a 'position' column)
                $card->position = $index + 1;
                $card->save();
            }
        }
        
        // Refresh the cards
        $this->loadCards();
        
        // Show success message
        session()->flash('message', 'Timeline order updated successfully!');
    }
    
    /**
     * Load timeline cards
     */
    private function loadCards()
    {
        // Load cards ordered by position
        $this->cards = TimelineCard::orderBy('position', 'asc')->get();
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
        return view('livewire.admin.aboutus.timeline.timeline-manager');
    }
}
