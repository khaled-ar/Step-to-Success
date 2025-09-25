<?php

namespace App\Http\Requests\Admin\Units;

use App\Models\Unit;
use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            'title'     => ['required', 'string', 'max:100'],
            'description'   => ['required', 'string', 'max:2000'],
        ];
    }

    public function store() {
        $unit = Unit::create($this->validated());
        return $this->generalResponse($unit->id, '201', 201);
    }
}
