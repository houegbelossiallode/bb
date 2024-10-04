<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RdsRequest extends FormRequest
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
            "notes"=> 'nullable',
            "date_du_rdv"=> 'required',
            "prime"=> 'required|numeric',
            "client_id"=> 'required|exists:clients,id',



        ];
    }


    public function messages()
    {
        return [
            "date_du_rdv.required"=> 'Ce champ est obligatoire',
            "prime.required"=> 'Ce champ est requis',
            "client_id.required"=> 'Veuillez choisir un prospect',


        ];
    }
}