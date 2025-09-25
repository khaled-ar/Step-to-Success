<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\{
    Course,
    Lesson,
    Question,
    Subscription
};

class FetchDataController extends Controller
{
    public function courses_with_units() {
        $courses = Course::with(['units', 'pre_questions'])
            ->whereType(request('type'))
            ->get();

        $subscription = Subscription::whereUserId(request()->user()->id)
            ->whereSubscribable('all_courses')
            ->where('status', '<>', 'inactive')
            ->first();

        if(!$subscription) {
            foreach($courses as $course) {
                $subscription_course = Subscription::whereUserId(request()->user()->id)
                ->whereCourseId($course->id)
                ->where('status', '<>', 'inactive')
                ->first();
                $course['buy_btn'] = $subscription_course ? 0 : 1;
            }
        }

        return $this->generalResponse(['buy_all_btn' => $subscription ? 0 : 1, 'courses' => $courses]);
    }

    public function questions_with_answers() {
        return $this->generalResponse(Question::with(['notes', 'answers'])
            ->whereLessonId(request('lesson_id'))
            ->whereType(request('type'))
            ->orderBy('question_number')
            ->get()
        );
    }

    public function lessons() {
        return $this->generalResponse(Lesson::whereUnitId(request('unit_id'))->get());
    }

}
