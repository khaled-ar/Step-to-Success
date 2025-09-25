<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
