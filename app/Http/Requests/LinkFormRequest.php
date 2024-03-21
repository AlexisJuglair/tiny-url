<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkFormRequest extends FormRequest
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
            'link' => ['required', 'url'],
            'name' => ['required', 'min:3'],
            'alias' => ['required' ,'regex:/^[a-z0-9-]+$/i', 'min:6', 'max:8'],
            'validation_date' => ['required', 'date', 'after:now'],
            'show' => ['boolean'],
        ];
    }

    public function messages()
    {
        return [
            'link.required' => 'Le champ lien est requis.',
            'link.url' => 'Le champ lien doit être une URL valide.',
            'name.required' => 'Le champ nom est requis.',
            'name.min' => 'Le champ nom doit avoir une longueur minimale de 3 caractères.',
            'alias.required' => 'Le champ alias est requis.',
            'alias.regex' => 'Le champ alias doit être un slug valide (lettres miniscules, chiffres, tiret ou underscore).',
            'alias.min' => 'Le champ alias doit avoir une longueur minimale de 6 caractères.',
            'alias.max' => 'Le champ alias doit avoir une longueur maximale de 8 caractères.',
            'validation_date.required' => 'Le champ de la date de validation est requis.',
            'validation_date.date' => 'Le champ de la date de validation foit être une date valide.',
            'validation_date.after' => 'La date de validation doit être postérieure à la date actuelle.',
            'show.boolean' => 'Le champ afficher doit être un booléen.',
        ];
    }
}
