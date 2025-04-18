<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;    
use App\Enums\QuestionType;

class Poll_Question extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'type' => QuestionType::class,
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function poll_question_answers()
    {
        return $this->hasMany(Poll_Question_Answer::class);
    }
}