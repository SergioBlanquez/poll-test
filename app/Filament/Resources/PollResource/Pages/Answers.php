<?php

namespace App\Filament\Resources\PollResource\Pages;

use App\Filament\Resources\PollResource;
use Filament\Resources\Pages\Page;
use App\Models\Poll;
use Illuminate\Support\Collection;
use App\Models\Poll_Question;
use App\Models\Poll_Question_Answer;
class Answers extends Page
{
    protected static string $resource = PollResource::class;

    protected static string $view = 'filament.resources.poll-resource.pages.answers';

    public Poll $record;
    public Poll_Question_Answer $answer;


        public function mount(Poll $record)
        {
            $this->record = $record->load(['poll_questions.poll_question_answers']);
        }

    public function getQuestions(): Collection
    {
        return $this->record->poll_questions()->with('poll_question_answers')->get();
    }
}
