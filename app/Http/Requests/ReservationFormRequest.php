<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationFormRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette demande.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Vous pouvez ajuster l'autorisation selon vos besoins
    }

    /**
     * Renvoie les règles de validation qui s'appliquent à la demande.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'competitions' => 'required|array',
            'competitions.*' => 'exists:competitions,id',
            'first_name' => 'required|array',
            'first_name.*' => 'string|max:255',
            'last_name' => 'required|array',
            'last_name.*' => 'string|max:255',
            'phone_number' => 'required|array',
            'phone_number.*' => 'string|max:20',
            'email' => 'required|array',
            'email.*' => 'email|max:255',
        ];
    }

    /**
     * Renvoie les messages d'erreur personnalisés pour les règles de validation définies.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'competitions.required' => 'Veuillez sélectionner au moins une compétition.',
            'competitions.*.exists' => 'Une ou plusieurs compétitions sélectionnées sont invalides.',
            'first_name.*.required' => 'Le prénom du spectateur est requis.',
            'first_name.*.string' => 'Le prénom du spectateur doit être une chaîne de caractères.',
            'first_name.*.max' => 'Le prénom du spectateur ne doit pas dépasser :max caractères.',
            'last_name.*.required' => 'Le nom du spectateur est requis.',
            'last_name.*.string' => 'Le nom du spectateur doit être une chaîne de caractères.',
            'last_name.*.max' => 'Le nom du spectateur ne doit pas dépasser :max caractères.',
            'phone_number.*.required' => 'Le numéro de téléphone du spectateur est requis.',
            'phone_number.*.string' => 'Le numéro de téléphone du spectateur doit être une chaîne de caractères.',
            'phone_number.*.max' => 'Le numéro de téléphone du spectateur ne doit pas dépasser :max caractères.',
            'email.*.required' => "L'email du spectateur est requis.",
            'email.*.email' => "L'email du spectateur doit être une adresse email valide.",
            'email.*.max' => "L'email du spectateur ne doit pas dépasser :max caractères.",
        ];
    }
}
