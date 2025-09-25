<?php

namespace App\Http\Requests\Admin\PreQuestions;

use App\Models\PreQuestion;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Files;

class StorePreQuestionRequest extends FormRequest
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
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'title' => ['required', 'string', 'max:100'],
            'file' => ['required', 'file', 'mimes:png,jpg,pdf', 'max:4096'],
        ];
    }

    public function store() {
        $file_name = Files::moveFile($this->file, 'Files/Pre_Questions');
        PreQuestion::create(['course_id' => $this->course_id, 'title' => $this->title, 'file' => $file_name]);
        return $this->generalResponse(null, '201', 201);
    }
}
