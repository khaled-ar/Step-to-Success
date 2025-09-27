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

    protected $appends = [
        'available'
    ];

    private function isFirstLessonInUnit($unitId) {
        $firstLesson = Lesson::whereUnitId($unitId)->oldest()->first();
        return $firstLesson && $firstLesson->id === $this->id;
    }

    public function getAvailableAttribute() {

        if (request()->has('unit_id') && $this->isFirstLessonInUnit(request('unit_id'))) {
            return 1;
        }

        $user = request()->user();
        $has_all_courses_subscription = $user->subscriptions()
            ->whereStatus('active')
            ->where(function($query) {
                $query->where('subscribable', 'all_courses')
                    ->orWhere('subscribable', 'جميع المواد');
            })
            ->first();

        if($has_all_courses_subscription) {
            return  $this->unit->course->type == $has_all_courses_subscription->type ? 1 : 0;
        }

        $subscriptions = $user->subscriptions()->whereStatus('active')->whereSubscribable('single_course')->get();
        foreach($subscriptions as $subscription) {
            if($this->unit->course_id == $subscription->course->id) {
                return 1;
            }
        }
        return 0;
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
