<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Questions\StoreQuestionRequest;
use App\Http\Requests\Admin\Questions\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Traits\Files;


class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->generalResponse(Question::whereLessonId(request('lesson_id'))
            ->whereType(request('type'))
            ->orderBy('question_number')
            ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        return $request->store();
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
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        return $request->update($question);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        if($question->image) {
            foreach(explode('|', $question->image) as $image) {
                Files::deleteFile(public_path("Images/Questions/{$image}"));
            }
        }
        $question->delete();
        return $this->generalResponse(null, 'Deleted Successfully', 200);
    }
}
