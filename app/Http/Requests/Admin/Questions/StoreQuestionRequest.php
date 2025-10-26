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
            'images' => ['required_without:text', 'array'],
            'images.*' => ['image' ,'mimes:png,jpg', 'max:2048'],
            'text' => ['required_without:images', 'string', 'max:1000'],
            'note' => ['string', 'max:1000'],
        ];
    }

    public function store() {
        $data = $this->validated();
        if($this->images) {
            $images = $this->images;
            $names = [];
            foreach($images as $image) {
                $names[] = Files::moveFile($image, 'Images/Questions');
            }
            unset($data['images']);
            $data['image'] = implode('|', $names);
        }
        $qeusetion = Question::create($data);
        return $this->generalResponse($qeusetion->id, '201', 201);
    }
}
