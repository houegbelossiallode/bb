<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Realisation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function commercial()
    {
        return $this->belongsTo(Commercial::class);
    }

    public function objectif()
    {
        return $this->belongsTo(Objectif::class);
    }
}
