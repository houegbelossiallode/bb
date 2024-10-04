<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntrepriseRequest extends FormRequest
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
            'raison' => 'required',
            'secteur' => 'required',
            'adresse' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'raison.required' => 'Veuillez entrer le nom de l\'entreprise',
            'secteur.required' => 'Veuillez entrer le secteur d\'activité de l\'entreprise',
            'adresse.required' => 'Veuillez entrer l\'adresse de l\'entreprise',
        ];
    }
}
