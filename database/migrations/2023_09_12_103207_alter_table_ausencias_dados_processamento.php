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
        Schema::table('ausencias', function (Blueprint $table) {
            $table->string('log')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->enum('status', ['agendado', 'processado', 'desbloqueado', 'erro'])->default('agendado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('ausencias', ['log']);
    }
};
