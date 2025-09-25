<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PreQuestions\StorePreQuestionRequest;
use App\Models\PreQuestion;
use Illuminate\Http\Request;
use App\Traits\Files;

class PreQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->generalResponse(PreQuestion::whereCourseId(request('course_id'))->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePreQuestionRequest $request)
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreQuestion $pre_question)
    {
        Files::deleteFile(public_path("Files/Pre_Questions/{$pre_question->file}"));
        $pre_question->delete();
        return $this->generalResponse(null, 'Deleted Successfully', 200);
    }
}
