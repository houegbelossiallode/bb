<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarif extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];


    public function compagnie()
    {
        return $this->belongsTo(Compagnie::class);
    }

    public function conditiongroupe()
    {
        return $this->belongsTo(Conditiongroupe::class);
    }
}
