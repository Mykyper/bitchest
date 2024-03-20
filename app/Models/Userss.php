<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Userss extends Authenticatable
{
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = ['nom', 'prénom','pseudo', 'mail', 'password','portefeuille_id'];
    protected $guard = 'web';
    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'id', 'portefeuille_id');
    }
}
