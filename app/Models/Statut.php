<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statut extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function commercials()
    {
        return $this->hasMany(Commercial::class);
    }

    public function objectifs()
    {
        return $this->hasMany(Objectif::class);
    }

    public function delete()
    {
        $this->commercials()->delete();
        $this->objectifs()->delete();

        parent::delete();
    }
}
