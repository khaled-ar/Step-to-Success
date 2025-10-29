<?php

namespace App\Http\Requests\Admin\Answers;

use App\Models\Answer;
use App\Traits\Files;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAnswersRequest extends FormRequest
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
            'is_correct' => ['boolean'],
            //'image' => ['image', 'mimes:png,jpg', 'max:2048'],
            'text' => ['string', 'max:1000'],
        ];
    }

    public function update($answer) {
        $data = $this->validated();
        // if($this->file('image')) {
        //     $data['image'] = Files::moveFile($this->image, 'Images/Answers');
        //     Files::deleteFile(public_path("Images/Answers/{$answer->image}"));
        // }
        $answer->update($data);
        return $this->generalResponse(null, 'Updated Successfully', 200);
    }
}
