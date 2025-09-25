<?php

namespace App\Http\Requests\Admin\Answers;

use App\Models\Answer;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Files;

class StoreAnswersRequest extends FormRequest
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
            'question_id' => ['required', 'integer', 'exists:questions,id'],
            'is_correct' => ['boolean'],
            'image' => ['required_without:text', 'image', 'mimes:png,jpg', 'max:2048'],
            'text' => ['required_without:image', 'string', 'max:1000'],
        ];
    }

    public function store() {
        $data = $this->validated();
        if($this->file('image')) {
            $data['image'] = Files::moveFile($this->image, 'Images/Answers');
        }
        Answer::create($data);
        return $this->generalResponse(null, '201', 201);
    }
}
