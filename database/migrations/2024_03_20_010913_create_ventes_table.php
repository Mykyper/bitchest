<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crypto_achat_id');
            $table->foreign('crypto_achat_id')->references('id')->on('crypto_achats')->onDelete('cascade');
            $table->unsignedBigInteger('portefeuille_id');
            $table->foreign('portefeuille_id')->references('id')->on('portefeuilles')->onDelete('cascade');
            $table->integer('valeur_vente');
            $table->integer('plus_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
