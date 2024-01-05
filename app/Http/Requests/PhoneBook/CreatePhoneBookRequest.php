<?php

namespace App\Http\Requests\PhoneBook;

use Illuminate\Foundation\Http\FormRequest;

class CreatePhoneBookRequest extends FormRequest
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
        // Phone Book Information
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'mobile_number' => 'required|string|max:20',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => __('validation.name.required'),
            'last_name.required' => __('validation.last_name.required'),
            'phone_number.required' => __('validation.phone_number.required'),
            'mobile_number.required' => __('validation.mobile_number.required'),
            'company.required' => __('validation.company.required'),
            'position.required' => __('validation.position.required'),
        ];
    }

}
