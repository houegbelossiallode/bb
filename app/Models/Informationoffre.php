<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informationoffre extends Model
{
    use HasFactory, SoftDeletes;

    //protected $guarded = [''];

    protected $fillable = [
        'type',
        'nom',
        'options',
        'ordre',
        'etat',
        'offre_id',
    ];
    protected $casts = [
        'options' => 'array',
    ];



    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }
}
