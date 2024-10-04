<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function typeproduit()
    {
        return $this->belongsTo(Typeproduit::class);
    }

    public function garanties()
    {
        return $this->hasMany(Garantie::class);
    }

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }

    public function infos()
    {
        return $this->hasMany(Informationproduit::class);
    }

    public function infoproductions()
    {
        return $this->hasMany(Informationproduction::class);
    }


    public function infoassureurs()
    {
        return $this->hasMany(Informationproduitassureur::class);
    }

    public function conditions()
    {
        return $this->hasMany(Condition::class);
    }

    public function conditiongroupes()
    {
        return $this->hasMany(Conditiongroupe::class);
    }

    public function delete()
    {
        $this->productions()->delete();
        $this->garanties()->delete();
        $this->offres()->delete();
        $this->infos()->delete();
        $this->infoproductions()->delete();
        $this->infoassureurs()->delete();
        $this->conditions()->delete();
        $this->conditiongroupes()->delete();

        parent::delete();
    }
}
