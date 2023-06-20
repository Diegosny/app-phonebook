<?php

namespace App\Http\Requests;

use App\Models\Contact;
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
            'phone' => ['required', 'phone', 'string', function ($attribute, $value, $fail) {
                $contact = Contact::whereUserId(auth()->user()->id)
                    ->wherePhone($value)
                    ->exists();

                if($contact) {
                    $fail('Este número de telefone já está em sua agenda');
                }
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.phone' => 'O número de telefone é inválido.',
        ];
    }
}
