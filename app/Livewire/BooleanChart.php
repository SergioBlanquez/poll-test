<?php

namespace App\Livewire;

use Livewire\Component;

class BooleanChart extends Component

{

    public $question;

    public function mount($question)
    {
        $this->question = $question;
    }

    public function render()
    {
        return view('livewire.boolean-chart');
    }
}
