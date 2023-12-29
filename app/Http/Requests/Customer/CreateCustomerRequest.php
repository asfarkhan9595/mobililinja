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
        return [
            // Company Information
            'customer_number' => 'nullable|string|max:255',
            'company_name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'vat' => 'required|string|max:50',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_email' => 'required|email|max:255',
            'contact_person_phone' => 'required|string|max:20',

            // Features
            'pbx' => 'nullable|string|max:255',
            'extensions' => 'nullable|string|max:255',
            'ivr' => 'nullable|string|max:255',
            'voicemail' => 'nullable|string|max:255',
            'ring_groups' => 'nullable|string|max:255',
            'conferences' => 'nullable|string|max:255',
            'call_recording' => 'nullable|string|max:255',
            'callback' => 'nullable|string|max:255',
            'calendar' => 'nullable|string|max:255',
            'reports' => 'nullable|string|max:255',
            'dashboard' => 'nullable|string|max:255',
            'speech_to_text' => 'nullable|string|max:255',
            'ai' => 'nullable|string|max:255',

            // Billing
            'billing_full_name' => 'nullable|string|max:255',
            'billing_card_number' => 'nullable|string|max:20',
            'billing_expiration_month' => 'nullable|string|max:2',
            'billing_expiration_year' => 'nullable|string|max:4',
            'billing_cvv' => 'nullable|string|max:4',
        ];

    }
}
