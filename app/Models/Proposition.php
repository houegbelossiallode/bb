<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposition extends Model
{
    use HasFactory, SoftDeletes;

    // protected $guarded = [''];
    protected $fillable = [
        'informationRequise',
        'reduction',
        'accessoire',
        'taxe',
        'primeTotale',
        'offre_id',
        'compagnie_id',
        'statut',
    ];
    protected $casts = [
        'informationRequise' => 'array',
    ];


    public function compagnie()
    {
        return $this->belongsTo(Compagnie::class);
    }

    public function details()
    {
        return $this->hasMany(Detailproposition::class);
    }

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }


    public function police()
    {
        return $this->hasOne(Policeassurance::class);
    }

    public function delete()
    {
        $this->details()->delete();

        parent::delete();
    }
}
