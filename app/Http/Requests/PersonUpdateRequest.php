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
            'firstName' => 'string',
            'lastName' => 'string',
            'nickname' => 'string',
            'birthDate' => 'date',
            'countryId' => 'integer'
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
            'first_name' => $this->input('firstName'),
            'last_name' => $this->input('lastName'),
            'nickname' => $this->input('nickname'),
            'birth_date' => $this->input('birthDate'),
            'country_id' => $this->input('countryId')
        ];

        return array_filter($input);
    }
}
