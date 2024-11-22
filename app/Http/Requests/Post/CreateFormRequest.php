<?php

namespace App\Http\Requests\Post;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'thumb' => 'required'
        ];
    }
    public function messages(): array
        {
            return [
            'title.required' => 'Please enter title',
            'thumb.required' => 'Please do not leave the photo blank',
            
                 ];
        }
}
