<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UserAdd extends FormRequest
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
            'fname' => 'required|string|min:3|max:255|regex:/^[\pL\s\-\.]+$/u',
            'mi' => 'required|string|max:2|regex:/^[\pL\s\-\.]+$/u',
            'lname' => 'required|string|min:2|max:255|regex:/^[\pL\s\-\.]+$/u',
            'phone' => 'required|numeric|regex:/(09)[0-9]{9}/|digits:11',
            'status' =>  'required|string|max:1',
            'email' => 'required|string|email|max:255|unique:users',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|string|min:8|regex:/^\S*$/u',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        flash()->error('Validation Error', 'Please fill the form correctly.');
        throw (new ValidationException($validator));
    }
}