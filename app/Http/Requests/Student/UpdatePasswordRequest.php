<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
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
            'password' => ['string', 'confirmed', Password::min(8)
                    ->max(25)
                    ->numbers()
                    ->symbols()
                    ->mixedCase()
                    ->uncompromised()],
        ];
    }

    public function update() {
        $user = $this->user();
        $user->update(['password' => Hash::make($this->password)]);
        return $this->generalResponse(null, 'Updated Successfully', 200);
    }
}
