<?php

namespace App\Http\Requests;

use App\Enums\DataFormat;
use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
            'id' => 'required|integer',
            'loadWith' => 'string',
            'data_format' => 'required|string|enum_value:' . DataFormat::class
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'data_format.enum_value' => 'Invalid data format. Data formats supported: JSON and XML'
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
            'loadWith' => $this->input('loadWith'),
            'data_format' => $this->input('data_format')
        ];

        return array_filter($input);
    }
}
