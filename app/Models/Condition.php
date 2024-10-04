<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condition extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function valeurs()
    {
        return $this->hasMany(Conditionvaleur::class);
    }

    
    public function superieure()
    {
        return $this->belongsTo(Condition::class, 'parent_id');
    }

    public function inferieures()
    {
        return $this->hasMany(Condition::class, 'parent_id');
    }

    public function delete()
    {
        $this->valeurs()->delete();
        $this->liaisons()->delete();
        $this->inferieures()->delete();

        parent::delete();
    }

    public function getSuperieureHierachie()
    {
        $hierachie = [];
        $currentSuperieure = $this->superieure;

        while ($currentSuperieure) {
            $hierachie[] = $currentSuperieure;
            $currentSuperieure = $currentSuperieure->superieure;
        }

        return $hierachie;
    }

    public function getInferieureHierachie()
    {
        $inferieures = [];
        foreach ($this->inferieures as $inferieure) {
            $inferieures[] = $inferieure;
            $inferieures = array_merge($inferieures, $inferieure->getInferieureHierachie());
        }
        return $inferieures;
    }
}
