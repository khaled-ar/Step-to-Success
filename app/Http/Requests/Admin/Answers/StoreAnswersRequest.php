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
            'images' => ['required_without:text', 'array'],
            'images.*' => ['image' ,'mimes:png,jpg'],
            'text' => ['required_without:images', 'string'],
        ];
    }

    public function store() {
        $data = $this->validated();
        if($this->images) {
            $images = $this->images;
            $names = [];
            foreach($images as $image) {
                $names[] = Files::moveFile($image, 'Images/Answers');
            }
            unset($data['images']);
            $data['image'] = implode('|', $names);
        }
        Answer::create($data);
        return $this->generalResponse(null, '201', 201);
    }
}
