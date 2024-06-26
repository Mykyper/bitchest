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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50);
            $table->string('prénom', 50);
            $table->string('pseudo', 50);
            $table->string('password', 150);
            $table->string('mail', 50)->unique();
            $table->unsignedBigInteger('portefeuille_id');
            $table->foreign('portefeuille_id')->references('id')->on('portefeuilles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
