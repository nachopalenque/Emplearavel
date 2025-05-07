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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_empleado')->references('id')->on('empleados')->onDelete('cascade');
            $table->string('titulo');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->string('tipo_evento');
            $table->string('observaciones')->default('');
            $table->string('adjunto')->default('');
            $table->string('estado_evento')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
