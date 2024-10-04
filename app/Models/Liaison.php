<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Liaison extends Model
{
    use HasFactory, SoftDeletes;


    protected $guarded = [''];


    public function conditionvaleur()
    {
        return $this->belongsTo(Conditionvaleur::class);
    }

    public function groupe()
    {
        return $this->belongsTo(Conditiongroupe::class);
    }
}
