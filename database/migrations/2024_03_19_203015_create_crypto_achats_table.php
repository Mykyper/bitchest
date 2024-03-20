<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoAchatsTable extends Migration
{
    public function up()
    {
        Schema::create('crypto_achats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portefeuille_id');
            $table->unsignedBigInteger('crypto_id');
            $table->integer('quantite');
            $table->timestamps();

            $table->foreign('portefeuille_id')->references('id')->on('portefeuilles');
            $table->foreign('crypto_id')->references('id')->on('cryptos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('crypto_achats');
    }
}
