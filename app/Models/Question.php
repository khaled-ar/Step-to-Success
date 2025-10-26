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
        $images = explode('|', $this->image);
        $images_url = [];
        foreach($images as $image) {
            $images_url[] = asset('Images/Questions') . "/$image";
        }
        return $images_url;
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
