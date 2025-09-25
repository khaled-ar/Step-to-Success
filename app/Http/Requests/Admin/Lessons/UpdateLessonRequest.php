<?php

namespace App\Http\Requests\Admin\Lessons;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
            'title' => ['string', 'max:100'],
        ];
    }

    public function update($lesson) {
        $lesson->update($this->validated());
        return $this->generalResponse($lesson, 'Updated Successfully', 200);
    }
}
