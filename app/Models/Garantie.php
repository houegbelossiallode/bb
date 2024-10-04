<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garantie extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];


    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function details()
    {
        return $this->hasMany(Detailoffre::class);
    }

    public function infos()
    {
        return $this->hasMany(Informationgarantie::class);
    }

    public function delete()
    {
        $this->details()->delete();
        $this->infos()->delete();

        parent::delete();
    }
}
