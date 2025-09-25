<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = request()->user()->favorite()
            ->with('question.answers', 'question.lesson.unit.course')
            ->get();

        $grouped = $favorites->groupBy(function ($favorite) {
            return $favorite->question->lesson->unit->course->id;
        })->map(function ($courseFavorites, $courseId) {
            $course = $courseFavorites->first()->question->lesson->unit->course;

            return [
                'course_id' => $courseId,
                'course_name' => $course->name,
                'questions' => $courseFavorites->map(function ($favorite) {
                    $question = $favorite->question;
                    $question->favorite_id = $favorite->id;
                    unset($question->lesson);
                    return $question;
                })
            ];
        })->values();

        return $this->generalResponse($grouped);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(['question_id' => ['required', 'integer', 'exists:questions,id']]);
        $request->user()->favorite()->create($data);
        return $this->generalResponse(null, '201', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        $favorite->delete();
        return $this->generalResponse(null, 'Deleted Successfully', 200);
    }
}
