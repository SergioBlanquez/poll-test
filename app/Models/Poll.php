<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Poll extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'status',
        'start_date',
        'end_date',
        'poll_creator_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($poll) {
            $creator = User::find($poll->poll_creator_id);
            
            if (!$creator) {
                throw new \Exception('Usuario no encontrado');
            }
            
            if (!$creator->poll_creator) {
                throw new \Exception('El usuario con ID ' . $creator->id . ' no es un creador. Su tipo es: ' . $creator->getUserTypeLabelAttribute());
            }
        });
    }

    public function poll_questions()
    {
        return $this->hasMany(Poll_Question::class);
    }

    public function poll_question_answers()
    {
        return $this->hasMany(Poll_Question_Answer::class);
    }

    public function poll_creator()
    {
        return $this->belongsTo(User::class, 'poll_creator_id');
    }
}