<?php
namespace App\Http\Requests\Trunk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrunkRequest extends FormRequest
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
        // Trunk Information for Update
        return [
            'tname' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'secret' => 'required|string|max:255',
            'authentication' => 'required|string|max:255',
            'registration' => 'required|string|max:255',
            'sip_server' => 'required|string|max:255',
            'sip_secret_port' => 'required|integer',
            'context' => 'required|string|max:255',
            'transport' => 'required|string|max:255',
        ];
    }
}
