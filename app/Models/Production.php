<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Production extends Model
{
    use HasFactory, SoftDeletes;

    // protected $guarded = [''];
    protected $fillable = [
        'informationRequise',
        'reduction',
        'prime',
        'statut',
        'conditiongroupe_id',
        'client_id',
        'compagnie_id',
        'reference',
    ];
    protected $casts = [
        'informationRequise' => 'array',
    ];

    public function conditiongroupe()
    {
        return $this->belongsTo(Conditiongroupe::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function compagnie()
    {
        return $this->belongsTo(Compagnie::class);
    }
}
