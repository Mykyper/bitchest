<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = ['crypto_achat_id', 'portefeuille_id', 'valeur_vente'];

    public function cryptoAchat()
    {
        return $this->belongsTo(CryptoAchat::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
