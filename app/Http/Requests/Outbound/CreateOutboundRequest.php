<?php

namespace App\Http\Requests\Outbound;

use Illuminate\Foundation\Http\FormRequest;

class CreateOutboundRequest extends FormRequest
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
        // Outbound Information
        return [
            'prepend' => 'required|string|max:255',
            'prefix' => 'required|string|max:255',
            'match_pattern' => 'required|string|max:255',
            'trunk_id' => 'required|integer',
           
        ];
    }

    public function messages()
    {
        return [
            'prepend.required' => __('validation.prepend.required'),
            'prefix.required' => __('validation.prefix.required'),
            'match_pattern.required' => __('validation.match_pattern.required'),
            'trunk_id.integer' => __('validation.trunk_id.integer'),
        ];
    }
}
