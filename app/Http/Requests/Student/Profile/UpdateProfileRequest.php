<?php

namespace App\Http\Requests\Student\Profile;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Files;

class UpdateProfileRequest extends FormRequest
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
            'username' => ['string', 'max:50', 'unique:users,username'],
            'image' => ['image', 'max:2048', 'mimes:png,jpg'],
        ];
    }

    public function update() {
        $user = $this->user();
        $user->update($this->except('image'));
        if($this->file('image')) {
            $image = Files::moveFile($this->image, 'Images/Profiles');
            Files::deleteFile(public_path("Images/Profiles/{$user->image}"));
            $user->update(['image' => $image]);
        }

        unset($user->email, $user->email_verified_at, $user->role);
        return $this->generalResponse($user, 'Updated Successfully', 200);
    }
}
