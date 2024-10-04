<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function dossieroffre()
    {
        return $this->belongsTo(Dossieroffre::class);
    }

    public function compagnie()
    {
        return $this->belongsTo(Compagnie::class);
    }
}
