<?php

namespace App\Http\Requests;

use App\Models\Compagnie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Veuillez entrer le nom de la compagnie',
            'nom.unique' => 'Ce nom de compagnie a été déjà enregistré',
            'compagnie.required' => 'Veuillez entrer l\'adresse de la compagnie',
        ];
    }
}
