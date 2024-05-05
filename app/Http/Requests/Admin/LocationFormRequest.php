<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class LocationFormRequest extends FormRequest
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
        $rules = [
            'capacity' => ['required', 'integer']
        ];

        if ($this->isMethod('post')) {
            $rules['name'] = ['required', 'unique:locations,name'];
        } elseif ($this->isMethod('put')) {
            $rules['name'] = ['required', Rule::unique('locations', 'name')->ignore($this->route('location')->id)];
        }

        return $rules;
    }


    public function messages(): array
    {
        return [
            'capacity.required' => 'La capacité est obligatoire.',
            'capacity.integer' => 'La capacité doit être un nombre entier.',
            'name.required' => 'Le nom est obligatoire.',
            'name.unique' => 'Ce nom est déjà utilisé.',
        ];
    }
}
