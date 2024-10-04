<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informationproduitassureur extends Model
{
    use HasFactory, SoftDeletes;

    //protected $guarded = [''];

    protected $fillable = [
        'type',
        'nom',
        'options',
        'ordre',
        'etat',
        'produit_id',
    ];
    protected $casts = [
        'options' => 'array',
    ];



    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
