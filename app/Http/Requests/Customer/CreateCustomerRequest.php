<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
        // Company Information
        return [
            'customer_number' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'vat' => 'required|string|max:50',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_email' => 'required|email|max:255',
            'contact_person_phone' => 'required|string|max:20',
        ];

    }
    public function messages()
    {
        return [
            'name.required' => __('validation.customer.name.required'),
            'street_address.required' => __('validation.street_address.required'),
            'zip.required' => __('validation.zip.required'),
            'city.required' => __('validation.city.required'),
            'country.required' => __('validation.country.required'),
            'vat.required' => __('validation.vat.required'),
            'contact_person_name.required' => __('validation.contact_person_name.required'),
            'contact_person_email.required' => __('validation.contact_person_email.required'),
            'contact_person_email.email' => __('validation.contact_person_email.email'),
            'contact_person_phone.required' => __('validation.contact_person_phone.required'),
        ];

    }
}
