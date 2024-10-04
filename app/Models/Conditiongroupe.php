<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conditiongroupe extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function liaisons()
    {
        return $this->hasMany(Liaison::class);
    }

    public function tarifs()
    {
        return $this->hasMany(Tarif::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function conditionValeurs()
    {
        return $this->belongsToMany(ConditionValeur::class, 'liaisons');
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }

    public function delete()
    {
        $this->productions()->delete();
        $this->liaisons()->delete();
        $this->tarifs()->delete();

        parent::delete();
    }
}
