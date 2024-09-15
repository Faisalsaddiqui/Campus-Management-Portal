<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'cnic' => 'required|numeric|digits:13|unique:users',
            'phone' => 'required|phone:PK',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date'
        ];
    }
}
