<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonCreateRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'nickname' => 'required|string',
            'birth_date' => 'required|date',
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
            'first_name' => $this->input('first_name'),
            'last_name' => $this->input('last_name'),
            'nickname' => $this->input('nickname'),
            'birth_date' => $this->input('birth_date'),
        ];

        return $input;
    }
}
