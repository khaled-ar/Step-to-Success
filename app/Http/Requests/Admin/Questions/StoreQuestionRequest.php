<?php

namespace App\Http\Requests\Admin\Questions;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Files;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lesson_id' => ['required', 'integer', 'exists:lessons,id'],
            'question_number' => ['required', 'integer'],
            'type' => ['required', 'string', 'in:automated,editorial'],
            'mark' => ['required', 'numeric'],
            'image' => ['required_without:text', 'image', 'mimes:png,jpg', 'max:2048'],
            'text' => ['required_without:image', 'string', 'max:1000'],
            'note' => ['string', 'max:1000'],
        ];
    }

    public function store() {
        $data = $this->validated();
        if($this->file('image')) {
            $data['image'] = Files::moveFile($this->image, 'Images/Questions');
        }
        $qeusetion = Question::create($data);
        return $this->generalResponse($qeusetion->id, '201', 201);
    }
}
