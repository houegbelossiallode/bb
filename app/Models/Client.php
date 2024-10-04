<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commercial()
    {
        return $this->belongsTo(Commercial::class);
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function dossieroffres()
    {
        return $this->hasMany(Dossieroffre::class);
    }

    public function retenus()
    {
        return $this->hasMany(Retenu::class);
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }

    public function delete()
    {
        $this->productions()->delete();
        $this->dossieroffres()->delete();
        $this->retenus()->delete();

        parent::delete();
    }
}
