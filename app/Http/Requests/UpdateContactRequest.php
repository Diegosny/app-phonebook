<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|phone|string|unique:contacts'
        ];
    }

    public function messages(): array
    {
        return [
            'phone.phone' => 'O número de telefone é inválido.',
            'phone.unique' => 'Este número de telefone já está em uso.'
        ];
    }
}
