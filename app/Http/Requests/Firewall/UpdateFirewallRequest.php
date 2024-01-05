<?php

namespace App\Http\Requests\Firewall;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFirewallRequest extends FormRequest
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
            'network_host' => 'required|string|max:255',
            'assigned_zone' => 'required|string|max:255',
            'customer' => 'required',
            'description' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'network_host.required' => __('firewall.validation.network_host.required'),
            'assigned_zone.required' => __('firewall.validation.assigned_zone.required'),
            'customer.required' => __('firewall.validation.customer.required'),
            'description.required' => __('firewall.validation.description.required')
        ];
    }
}
