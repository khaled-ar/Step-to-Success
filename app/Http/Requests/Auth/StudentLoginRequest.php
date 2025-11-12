<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StudentLoginRequest extends FormRequest
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
            'username' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }

    public function authenticate()
    {
        return Auth::attempt(
            [
                'username' => $this->username,
                'password' => $this->password,
            ]
        );
    }

    public function check() {
        if($this->authenticate()) {
            $user = User::whereUsername($this->username)->first();
            $user->tokens()->delete();
            $user['token'] = $user->createToken('auth_token')->plainTextToken;
            unset($user->email, $user->email_verified_at, $user->role);
            return $this->generalResponse($user, null, 200);
        }
        return $this->generalResponse(null, 'Wrong Credentials', 401);
    }
}
