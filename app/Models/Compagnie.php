<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compagnie extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function personnels()
    {
        return $this->hasMany(Personnel::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }


    public function propositions()
    {
        return $this->hasMany(Proposition::class);
    }

    public function tarifs()
    {
        return $this->hasMany(Tarif::class);
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }

    public function renseignementgaranties()
    {
        return $this->hasMany(Renseignementgarantie::class);
    }

    public function delete()
    {
        $this->productions()->delete();
        $this->renseignementgaranties()->delete();
        $this->personnels()->delete();
        $this->publications()->delete();
        $this->propositions()->delete();
        $this->tarifs()->delete();

        parent::delete();
    }

    // public function getLogoAttribute($value)
    // {
    //     if ($value) {
    //         return asset('users/compagnies/' . $value);
    //     } else {
    //         return asset('users/compagnies/noImage.jpg');
    //     }
    // }
}
