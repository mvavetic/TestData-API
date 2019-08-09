<?php

namespace App\Http\Requests;

use App\Enums\DataFormat;
use Illuminate\Foundation\Http\FormRequest;

class SportsListRequest extends FormRequest
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
            'dataFormat' => 'required|string|enum_value:' . DataFormat::class,
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
            'dataFormat.enum_value' => 'Invalid data format. Data formats supported: JSON and XML'
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
            'data_format' => $this->input('dataFormat')
        ];

        return $input;
    }
}
