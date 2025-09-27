<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        static::retrieved(function ($course) {
            $course->setAttribute('type', $course->type == 'scientific' ? 'علمي' : 'ادبي');
        });
    }

    public function units() {
        return $this->hasMany(Unit::class);
    }

    public function pre_questions() {
        return $this->hasMany(PreQuestion::class);
    }
}
