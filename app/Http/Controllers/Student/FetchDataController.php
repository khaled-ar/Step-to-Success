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

        if(in_array(request('type'), ['scientific', 'علمي'])) {
            $subscription = Subscription::whereUserId(request()->user()->id)
                ->whereIn('subscribable', ['all_courses', 'جميع المواد'])
                ->whereIn('status', ['active', 'pending'])
                ->whereIn('type', ['scientific', 'علمي'])
                ->first();
        } else {
            $subscription = Subscription::whereUserId(request()->user()->id)
                ->whereIn('subscribable', ['all_courses', 'جميع المواد'])
                ->whereIn('status', ['active', 'pending'])
                ->whereIn('type', ['literary', 'ادبي'])
                ->first();
        }

        if(!$subscription) {
            foreach($courses as $course) {
                $subscription_course = Subscription::whereUserId(request()->user()->id)
                ->whereCourseId($course->id)
                ->whereIn('status', ['active', 'pending'])
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
        $lessons = Lesson::whereUnitId(request('unit_id'))->get();
        return $this->generalResponse($lessons->makeHidden('unit'));
    }

}
