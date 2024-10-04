<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offre extends Model
{
    use HasFactory, SoftDeletes;

    // protected $guarded = [''];
    protected $fillable = [
        'informationRequise',
        'client_id',
        'produit_id',
        'dossieroffre_id',
    ];
    protected $casts = [
        'informationRequise' => 'array',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function dossieroffre()
    {
        return $this->belongsTo(Dossieroffre::class);
    }

    public function infos()
    {
        return $this->hasMany(Informationoffre::class);
    }

    public function details()
    {
        return $this->hasMany(Detailoffre::class);
    }

    public function propositions()
    {
        return $this->hasMany(Proposition::class);
    }


    public function police()
    {
        return $this->hasOne(Policeassurance::class);
    }

    public function delete()
    {
        $this->infos()->delete();
        $this->details()->delete();
        $this->propositions()->delete();
        $this->police()->delete();

        parent::delete();
    }
}
