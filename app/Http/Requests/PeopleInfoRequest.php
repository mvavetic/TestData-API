<?php

namespace App\Http\Requests;

use App\Enums\DataFormat;
use Illuminate\Foundation\Http\FormRequest;

class PeopleInfoRequest extends FormRequest
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
            'loadWith' => 'string|in:country',
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
            'loadWith.in' => 'You can only load with country.',
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
            'dataFormat' => $this->input('dataFormat')
        ];

        return $input;
    }
}
