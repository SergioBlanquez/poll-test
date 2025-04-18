<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Poll_Question;
use Livewire\WithPagination;

class TextAnswersTable extends Component
{
    use WithPagination;

    public Poll_Question $question;
    public $perPage = 10;

    protected $paginationTheme = 'simple-tailwind';

    public function mount(Poll_Question $question)
    {
        $this->question = $question;
    }

    public function render()
    {
        $answers = $this->question->poll_question_answers()
            ->with('user')
            ->paginate($this->perPage);

        return view('livewire.text-answers-table', [
            'answers' => $answers
        ]);
    }
} 