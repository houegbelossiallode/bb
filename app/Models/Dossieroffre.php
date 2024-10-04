<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dossieroffre extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function delete()
    {
        $this->offres()->delete();
        $this->publications()->delete();

        parent::delete();
    }
}
