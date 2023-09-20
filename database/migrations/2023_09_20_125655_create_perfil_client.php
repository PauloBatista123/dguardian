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
        Schema::create('client_perfil', function (Blueprint $table) {
            $table->uuid('client_id');
            $table->unsignedBigInteger('perfil_id');
            $table->foreign('client_id')->references('id')->on('oauth_clients');
            $table->foreign('perfil_id')->references('id')->on('perfils');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_perfil');
    }
};
