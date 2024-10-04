<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Typeproduit extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    public function delete()
    {
        $this->produits()->delete();

        parent::delete();
    }
}
