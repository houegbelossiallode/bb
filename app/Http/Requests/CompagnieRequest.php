<?php

namespace App\Http\Requests;

use App\Models\Compagnie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompagnieRequest extends FormRequest
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
            'nom' => ['required', Rule::unique(Compagnie::class)],
            'adresse' => 'required',
            'tel' => 'required',
            'logo' => 'required|mimes:png,jpg|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Veuillez entrer le nom de la compagnie',
            'nom.unique' => 'Ce nom de compagnie a été déjà enregistré',
            'adresse.required' => 'Veuillez entrer l\'adresse de la compagnie',
            'tel.required' => 'Veuillez entrer le téléphone de la compagnie',
            'logo.required' => 'Veuillez choisir le logo de la compagnie',
            'logo.mimes' => 'Le logo doit être de type : jpg ou png.',
            'logo.max' => 'Le logo ne doit pas depasser 100ko.',
        ];
    }
}
