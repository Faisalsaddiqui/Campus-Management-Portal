<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(StoreUserRequest $user_request)
    {
        return array_merge($user_request->rules(), [
            'session_type' => 'required|in:morning,evening',
            'program' => 'required|exists:programs,id'
        ]);
    }
}
