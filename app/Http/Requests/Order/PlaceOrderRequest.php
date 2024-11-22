<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
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
        $rules = [
            'shipToDifferentAddress' => 'sometimes|boolean',
        ];

        // Nếu chọn "Ship to a different address", thêm quy tắc validate cho các trường khác
        if ($this->input('shipToDifferentAddress')) {
            $rules = array_merge($rules, [
                'other_name' => 'required|string',
                'other_username' => 'required|string',
                'other_email' => 'required|email',
                'other_phone' => 'required|string',
                'other_address' => 'required|string',
                'province_id' => 'required',
                'district_id' => 'required',
                'ward_id' => 'required',
            ]);
        }

        return $rules;
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'other_name.required' => 'Please enter the recipient\'s name.',
            'other_username.required' => 'Please enter the recipient\'s username.',
            'other_email.required' => 'Please enter the recipient\'s email.',
            'other_email.email' => 'The recipient\'s email must be a valid email address.',
            'other_phone.required' => 'Please enter the recipient\'s phone number.',
            'other_address.required' => 'Please enter the recipient\'s address.',
            'province_id.required' => 'Please select a province.',
            'district_id.required' => 'Please select a district.',
            'ward_id.required' => 'Please select a ward.',
        ];
    }
}
