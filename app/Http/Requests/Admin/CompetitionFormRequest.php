<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompetitionFormRequest extends FormRequest
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
            'sport_id' => ['required','exists:sports,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'day' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:2024-01-01', 'before_or_equal:2024-12-31'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'after_or_equal:start_time', 'date_format:H:i'],
            'price' => ['required', 'integer'],
            'round' => ['required','in:Premier tour,Demi-finale,Finale']
        ];
    }

    public function messages(): array
    {
        return [
            'sport_id.required' => 'Le sport est requis.',
            'sport_id.exists' => 'Le sport sélectionné est invalide.',
            'location_id.required' => 'La location est requise.',
            'location_id.exists' => 'La location sélectionnée est invalide.',
            'day.required' => 'La date est requise.',
            'day.date' => 'La date doit être une date valide.',
            'day.date_format' => 'Le format de date doit être Y-m-d (ex. 2024-12-31).',
            'day.after_or_equal' => 'La date doit être après ou égale à 2024-01-01.',
            'day.before_or_equal' => 'La date doit être avant ou égale à 2024-12-31.',
            'start_time.required' => 'L\'heure de début est requise.',
            'start_time.date_format' => 'Le format de l\'heure de début doit être H:i (ex. 13:00).',
            'end_time.required' => 'L\'heure de fin est requise.',
            'end_time.after_or_equal' => 'L\'heure de fin doit être après ou égale à l\'heure de début.',
            'end_time.date_format' => 'Le format de l\'heure de fin doit être H:i (ex. 14:00).',
            'price.required' => 'Le prix est requis.',
            'price.integer' => 'Le prix doit être un nombre entier.',
            'round.required' => 'Le tour est requis.',
            'round.in' => 'Le tour doit être parmi "Premier tour", "Demi-finale" ou "Finale".',
        ];
    }
}

