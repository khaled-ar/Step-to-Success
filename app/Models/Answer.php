<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
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
        if($this->image == null) {
            return null;
        }
        $images = explode('|', $this->image);
        $images_url = [];
        foreach($images as $image) {
            $images_url[] = asset('Images/Answers') . "/$image";
        }
        return $images_url;
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
