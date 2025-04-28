<?php

namespace App\Livewire;

use Livewire\Component;

class QuillEditor extends Component
{
    public string $model;
    public $content;

    public function mount($model, $content = '')
    {
        $this->model = $model;
        $this->content = $content;
    }

    public function updateContent($html)
    {
        $this->dispatch('quillChanged', model: $this->model, html: $html);
    }

    public function render()
    {
        return view('livewire.quill-editor');
    }
}
