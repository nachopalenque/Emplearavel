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
        Schema::create('centros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('razon_social');
            $table->string('direccion');
            $table->string('pais');
            $table->string('provincia');
            $table->string('localidad');
            $table->string('codigo_postal');
            $table->string('estilo');
            $table->string('CIF',9);

      

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centros');

    }
};
