<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $casts = [
        'expiration_date' => 'datetime',
    ];

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'transfer_image',
        'expiration_date'
    ];

    protected $appends = [
        'transfer_image_url',
    ];

    public function getTransferImageUrlAttribute()
    {
        return $this->transfer_image ? asset("Images/Payments") . '/' . $this->transfer_image : null;
    }

    protected static function booted()
    {
        static::retrieved(function ($subscription) {
            $subscription->setAttribute('subscribable', $subscription->subscribable == 'single_course' ? 'مادة واحدة' : 'جميع المواد');
        });
    }

    public function user() {
        return $this->belongsTo(User::class)->select([
            'id', 'username', 'image'
        ]);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

}
