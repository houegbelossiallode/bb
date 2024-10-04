<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objectif extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function statut()
    {
        return $this->belongsTo(Statut::class);
    }

    public function realisations()
    {
        return $this->hasMany(Realisation::class);
    }

    public function delete()
    {
        $this->realisations()->delete();

        parent::delete();
    }
}
