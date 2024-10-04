<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detailproposition extends Model
{
    use HasFactory, SoftDeletes;

    //protected $guarded = [''];

    protected $fillable = [
        'detailPropositions',
        'proposition_id',
        'detailoffre_id',
        'prime',
        'surPrime',
    ];
    protected $casts = [
        'detailPropositions' => 'array',
    ];

    public function proposition()
    {
        return $this->belongsTo(Proposition::class);
    }

    public function detailoffre()
    {
        return $this->belongsTo(Detailoffre::class);
    }
}
