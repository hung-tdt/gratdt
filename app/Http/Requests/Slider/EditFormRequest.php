<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class EditFormRequest extends FormRequest
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
            'thumb' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter name.',
            'thumb.required' => 'Please select a photo.',
            'name.max' => 'Do not enter more than 100 characters.',
        ];
    }
}
