<?php

namespace App\Http\Requests\Admin\Courses;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'in:scientific,literary'],
            'price' => ['required', 'numeric']
        ];
    }

    public function store() {
        $course =  Course::create($this->validated());
        return $this->generalResponse($course->id, '201', 201);
    }
}
