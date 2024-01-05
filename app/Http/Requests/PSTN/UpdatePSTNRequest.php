<?php

namespace App\Http\Requests\PSTN;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePSTNRequest extends FormRequest
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
            'provider' => 'required|string|max:255',
            'number_pool' => 'required|string|max:255',
            'customer_id' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'provider.required' => __('validation.provider.required'),
            'number_pool.required' => __('validation.number_pool.required'),
            'customer_id.required' => __('validation.customer_id.required')
        ];
    }
}
