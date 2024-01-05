<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
            'number' => 'required|string|max:255',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'status' => 'required|string|max:255',
            'payment_mode' => 'required|string|max:255',
            'customer_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'number.required' => __('invoice.validation.number.required'),
            'date.required' => __('invoice.validation.date.required'),
            'date.date' => __('invoice.validation.date.date'),
            'amount.required' => __('invoice.validation.amount.required'),
            'amount.numeric' => __('invoice.validation.amount.numeric'),
            'status.required' => __('invoice.validation.status.required'),
            'payment_mode.required' => __('invoice.validation.payment_mode.required'),
            'customer_id.required' => __('invoice.validation.customer_id.required')
        ];
    }

}
