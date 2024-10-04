<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commercial extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function retenus()
    {
        return $this->hasMany(Retenu::class);
    }


    public function statut()
    {
        return $this->belongsTo(Statut::class);
    }

    public function realisations()
    {
        return $this->hasMany(Realisation::class);
    }

    public function chef()
    {
        return $this->belongsTo(Commercial::class, 'id_chef');
    }

    public function collaborateurs()
    {
        return $this->hasMany(Commercial::class, 'id_chef');
    }

    public function delete()
    {
        $this->clients()->delete();
        $this->retenus()->delete();
        $this->realisations()->delete();
        $this->collaborateurs()->delete();

        parent::delete();
    }

    public function getChefHierachie()
    {
        $hierachie = [];
        $currentChef = $this->chef;

        while ($currentChef) {
            $hierachie[] = $currentChef;
            $currentChef = $currentChef->chef;
        }

        return $hierachie;
    }

    public function getCollaborateurHierachie()
    {
        $collaborateurs = [];
        foreach ($this->collaborateurs as $collaborateur) {
            $collaborateurs[] = $collaborateur;
            $collaborateurs = array_merge($collaborateurs, $collaborateur->getCollaborateurHierachie());
        }
        return $collaborateurs;
    }
}
