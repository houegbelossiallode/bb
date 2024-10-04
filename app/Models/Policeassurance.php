<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policeassurance extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    public function proposition()
    {
        return $this->belongsTo(Proposition::class);
    }
}
