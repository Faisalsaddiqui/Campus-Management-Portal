<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
        return  [
            'course_name' => 'required|unique:courses,course_name,' . $this->route('course')->id,
            'course_code' => 'required|numeric|max:999|min:100',
            'practical_credit_hours' => 'required|numeric',
            'theory_credit_hours' => 'required|numeric',
            'department_code' => 'required',
        ];
    }
}
