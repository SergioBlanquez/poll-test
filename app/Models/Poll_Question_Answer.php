<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Poll_Question_Answer extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function poll_question()
    {
        return $this->belongsTo(Poll_Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}