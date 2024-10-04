<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conditionvaleur extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function liaisons()
    {
        return $this->hasMany(Liaison::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function conditiongroupes()
    {
        return $this->belongsToMany(Conditiongroupe::class, 'liaisons');
    }

    public function delete()
    {
        $this->liaisons()->delete();

        parent::delete();
    }
}
