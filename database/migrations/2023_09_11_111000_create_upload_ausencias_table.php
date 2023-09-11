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
        Schema::create('upload_ausencias', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('nome');
            $table->unsignedBigInteger('usuario_id');
            $table->integer('registros')->default(0);
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_ausencias');
    }
};
