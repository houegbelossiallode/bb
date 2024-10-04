<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Rd extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = ['prime','produit_id','client_id','commercial_id','notes','date_du_rdv'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function commercial()
    {
        return $this->belongsTo(Commercial::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

}