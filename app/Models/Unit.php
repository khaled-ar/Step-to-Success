<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
