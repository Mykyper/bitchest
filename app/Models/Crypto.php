<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    protected $table = 'cryptos';
    protected $fillable = ['nom', 'first_cotation','last_cotation',];
}
