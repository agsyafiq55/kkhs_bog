<?php

namespace App\Livewire;  // Changed from App\Http\Livewire

use Livewire\Component;

class QuillEditor extends Component
{
    public string $model;

    public function mount($model)
    {
        $this->model = $model;
    }

    public function render()
    {
        return view('livewire.quill-editor');
    }
}

