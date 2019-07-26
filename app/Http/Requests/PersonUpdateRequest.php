<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonUpdateRequest extends FormRequest
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
            'id' => 'required|integer|exists:people,id',
            'first_name' => 'string',
            'last_name' => 'string',
            'nickname' => 'string',
            'birth_date' => 'date',
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
            'id' => $this->input('id'),
            'first_name' => $this->input('first_name'),
            'last_name' => $this->input('last_name'),
            'nickname' => $this->input('nickname'),
            'birth_date' => $this->input('birth_date'),
        ];

        return array_filter($input);
    }
}
