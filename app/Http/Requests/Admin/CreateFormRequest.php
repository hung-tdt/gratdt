<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter name.',
            'email.required' => 'Please enter email address.',
            'email.email' => 'Invalid email address.',
            'email.unique' => 'Email address already exists.',
            'password.required' => 'Please enter password.',
            'password.min' => 'Password must contain at least 8 characters.',
            'password.confirmed' => 'Confirmation password does not match.',
        ];
    }
}
