<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Answers\StoreAnswersRequest;
use App\Http\Requests\Admin\Answers\UpdateAnswersRequest;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Traits\Files;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->generalResponse(Answer::whereQuestionId(request('question_id'))->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnswersRequest $request)
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
    public function update(UpdateAnswersRequest $request, Answer $answer)
    {
        return $request->update($answer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        if($answer->image) {
            foreach(explode('|', $answer->image) as $image) {
                Files::deleteFile(public_path("Images/Answers/{$image}"));
            }
        }
        $answer->delete();
        return $this->generalResponse(null, 'Deleted Successfully', 200);
    }
}
