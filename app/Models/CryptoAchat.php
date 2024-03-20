<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoAchat extends Model
{
    protected $table = 'crypto_achats';
    protected $fillable = ['portefeuille_id', 'crypto_id', 'quantite'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class,'portefeuille_id');
    }

    public function crypto()
    {
        return $this->belongsTo(Crypto::class);
    }
}

