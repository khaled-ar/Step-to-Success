<?php

namespace App\Http\Requests\Admin\Ads;

use App\Models\Ad;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Files;

class StoreAdRequest extends FormRequest
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
            'image' => ['required', 'image', 'mimes:png,jpg', 'max:2048']
        ];
    }

    public function store() {
        $image = Files::moveFile($this->image, 'Images/Ads');
        Ad::create(['image' => $image]);
        return $this->generalResponse(null, '201', 201);
    }
}
