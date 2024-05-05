<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SpectatorFormRequest extends FormRequest
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
            'competition_id' => ['required','exists:competitions,id'],
            'first_name' => ['required','string'],
            'last_name' => ['required','string'],
            'phone_number' => ['required','numeric','min:8'],
            'email' => ['required','email']
        ];
    }

    public function messages(): array
    {
        return [
            'competition_id.required' => 'Le champ ID de compétition est requis.',
            'competition_id.exists' => "L'ID de compétition spécifié n'existe pas.",
            'first_name.required' => 'Le prénom est requis.',
            'first_name.string' => 'Le prénom doit être une chaîne de caractères.',
            'last_name.required' => 'Le nom de famille est requis.',
            'last_name.string' => 'Le nom de famille doit être une chaîne de caractères.',
            'phone_number.required' => 'Le numéro de téléphone est requis.',
            'phone_number.numeric' => 'Le numéro de téléphone doit être un nombre.',
            'phone_number.min' => 'Le numéro de téléphone doit avoir au moins :min chiffres.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.'
        ];
    }
}
