<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agence extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function commercials()
    {
        return $this->hasMany(Commercial::class);
    }

    public function delete()
    {
        $this->commercials()->delete();

        parent::delete();
    }
}
