<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
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
            'degree_id' => 'required|integer|exists:degrees,id|unique:programs,degree_id,' . $this->route('program')->id . ',id,department_id,' . $this->department_id,
            'evening_option' => 'required|boolean',
            'morning_option' => 'required|boolean',
            'department_id' => 'required|integer|exists:departments,id',
            'credit_hours' => 'required|integer|max:999',
        ];
    }


    public function messages()
    {
        return [
            'department_id.required' => 'You need to specify a department',
            'degree_id.required' => 'You need to specify a degree',
            'degree_id.unique' => 'This degree already exists'
        ];
    }
}
