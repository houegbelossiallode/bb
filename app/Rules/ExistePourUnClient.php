<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ExistePourUnClient implements ValidationRule
{
    protected $clientId;

    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = DB::table('dossieroffres')
            ->where('reference', $value)
            ->where('client_id', $this->clientId)
            ->exists();

        if (!$exists) {
            $fail('La référence entrée n\'existe pas pour ce client.');
        }
    }
}
