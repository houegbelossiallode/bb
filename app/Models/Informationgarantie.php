<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informationgarantie extends Model
{
    use HasFactory, SoftDeletes;

    //protected $guarded = [''];

    protected $fillable = [
        'type',
        'nom',
        'options',
        'ordre',
        'etat',
        'garantie_id',
    ];
    protected $casts = [
        'options' => 'array',
    ];



    public function garantie()
    {
        return $this->belongsTo(Garantie::class);
    }

    public function renseignementgaranties()
    {
        return $this->hasMany(Renseignementgarantie::class);
    }

    public function delete()
    {
        $this->renseignementgaranties()->delete();

        parent::delete();
    }
}
