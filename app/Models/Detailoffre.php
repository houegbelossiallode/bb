<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detailoffre extends Model
{
    use HasFactory, SoftDeletes;

    //protected $guarded = [''];

    protected $fillable = [
        'detailOffres',
        'offre_id',
        'garantie_id',
    ];
    protected $casts = [
        'detailOffres' => 'array',
    ];

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    public function garantie()
    {
        return $this->belongsTo(Garantie::class);
    }

    public function detailpropositions()
    {
        return $this->hasMany(Detailproposition::class);
    }

    public function delete()
    {
        $this->detailpropositions()->delete();

        parent::delete();
    }
}
