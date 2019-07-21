<?php

namespace App\Http\Requests;

use App\Enums\DataFormat;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\VarDumper\Cloner\Data;

class PeopleListRequest extends FormRequest
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
            'count' => 'required|numeric',
            'data_format' => 'required|string|enum_value:' . DataFormat::class
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
            'count' => $this->input('count'),
            'data_format' => $this->input('data_format')
        ];

        return $input;
    }
}