<?php

namespace App\Http\Requests;

use App\Models\Agence;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgenceRequest extends FormRequest
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
            'libelle' => ['required', Rule::unique(Agence::class)],
            'adresse' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'libelle.required' => 'Veuillez entrer le nom de la compagnie',
            'libelle.unique' => 'Ce nom d\'agence a été déjà enregistré',
            'adresse.required' => 'Veuillez entrer l\'adresse de la compagnie',
        ];
    }
}
