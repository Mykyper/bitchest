<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    public $timestamps = false;
    protected $table = 'admin'; // Le nom de votre table dans la base de données

    protected $fillable = ['nom','prenom','pseudo','mail', 'password']; // Les colonnes que vous souhaitez remplir
    protected $guard = 'admin';
}
