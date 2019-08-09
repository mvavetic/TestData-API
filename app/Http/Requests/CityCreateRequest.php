<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityCreateRequest extends FormRequest
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
            'name' => 'required|string',
            'countryCode' => 'required|string'
        ];
    }

    /**
     * Validate given data and return array
     *
     * @return array
     */
    public function validateData() : array
    {
        $input = [
            'name' => $this->input('name'),
            'country_code' => $this->input('countryCode'),
            'country_id' => null
        ];

        return $input;
    }
}
