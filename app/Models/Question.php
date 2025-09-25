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
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset("Images/Questions") . '/' . $this->image : null;
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
