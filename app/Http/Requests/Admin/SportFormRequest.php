<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SportFormRequest extends FormRequest
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
            'name' => ['required','unique:sports,name','string']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du sport est requis.',
            'name.unique' => 'Le nom du sport doit être unique.',
            'name.string' => 'Le nom du sport doit être une chaîne de caractères.'
        ];
    }
}
