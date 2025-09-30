<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'image'
    ];

    protected $appends = [
        'image_url',
        'in_favorite'
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset("Images/Questions") . '/' . $this->image : null;
    }

    public function getInFavoriteAttribute()
    {
        return in_array($this->id, request()->user()->favorite()->pluck('question_id')->toArray());
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function notes() {
        return $this->hasMany(StudentQuestion::class)->where('user_id', request()->user()->id);
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }
}
