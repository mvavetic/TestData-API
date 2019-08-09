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
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'nickname' => 'required|string',
            'birthDate' => 'required|date',
            'countryId' => 'required|integer|exists:countries,id',
            'sportId' => 'required|integer|exists:sports,id'
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
            'first_name' => $this->input('firstName'),
            'last_name' => $this->input('lastName'),
            'nickname' => $this->input('nickname'),
            'birth_date' => $this->input('birthDate'),
            'country_id' => $this->input('countryId'),
            'sport_id' => $this->input('sportId')
        ];

        return $input;
    }
}
