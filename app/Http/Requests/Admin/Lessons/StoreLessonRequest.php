<?php

namespace App\Http\Requests\Admin\Lessons;

use App\Models\Lesson;
use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
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
            'unit_id' => ['required', 'integer', 'exists:units,id'],
            'title' => ['required', 'string', 'max:100'],
        ];
    }

    public function store() {
        $lesson =  Lesson::create($this->validated());
        return $this->generalResponse($lesson->id, '201', 201);
    }
}
