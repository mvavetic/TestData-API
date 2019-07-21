<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ];
    }

    /**
     * Validates user data and returns array of data
     *
     * @return array
     */
    public function validateData()
    {
        $input = [
            'email' => $this->input('email'),
            'password' => $this->input('password')
        ];
        return $input;
    }
}
