<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public $timestamps = false;
    protected $table = 'portefeuilles';
    protected $fillable = ['id','somme'];

        public function user()
        {
            return $this->belongsTo(Userss::class, 'portefeuille_id', 'id');
        }
        public function achats()
        {
            return $this->hasMany(CryptoAchat::class,'portefeuille_id');
        }
}
