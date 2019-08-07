<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\People;

class AvatarUpdateRequest extends FormRequest
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
        $personModel = new People();

        $person = $personModel->find($this->input('id'));

        $input = [
            'id' => $person->avatar->id,
            'image_url' => $this->input('avatar_url'),
        ];

        return $input;
    }
}
