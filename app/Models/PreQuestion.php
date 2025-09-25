<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreQuestion extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'file'
    ];

    protected $appends = [
        'file_url',
    ];

    public function getFileUrlAttribute()
    {
        return $this->file ? asset("Files/Pre_Questions") . '/' . $this->file : null;
    }
}
