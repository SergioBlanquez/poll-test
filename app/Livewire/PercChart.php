<?php

namespace App\Livewire;

use Livewire\Component;

class PercChart extends Component
{
    
    public $question;

    public function mount($question)
    {
        $this->question = $question;
    }

    public function render()
    {
        return view('livewire.perc-chart');
    }
}
