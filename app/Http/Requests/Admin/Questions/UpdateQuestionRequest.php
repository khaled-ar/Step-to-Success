<?php

namespace App\Http\Requests\Admin\Questions;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Files;

class UpdateQuestionRequest extends FormRequest
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
            'question_number' => ['integer'],
            'mark' => ['numeric'],
            //'image' => ['image', 'mimes:png,jpg', 'max:2048'],
            'text' => ['string'],
            'note' => ['string'],
        ];
    }

    public function update($question) {
        $data = $this->validated();
        // if($this->file('image')) {
        //     $data['image'] = Files::moveFile($this->image, 'Images/Questions');
        //     Files::deleteFile(public_path("Images/Questions/{$question->image}"));
        // }
        $question->update($data);
        return $this->generalResponse(null, 'Updated Successfully', 200);
    }
}
