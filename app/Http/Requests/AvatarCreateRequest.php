<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvatarCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar_url' => 'string'
        ];
    }

    /**
     * Validate given data and return array
     *
     * @return array
     */
    public function validateData()
    {
        $input = [
            'image_url' => $this->input('avatar_url'),
            'person_id' => null
        ];

        return $input;
    }
}
