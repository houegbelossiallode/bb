<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entreprise extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function delete()
    {
        $this->clients()->delete();

        parent::delete();
    }
}
