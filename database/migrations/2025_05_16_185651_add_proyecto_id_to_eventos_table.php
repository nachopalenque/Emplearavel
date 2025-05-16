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
        Schema::table('eventos', function (Blueprint $table) {
      $table->foreignId('id_proyecto')
                ->nullable() // o quita esto si es obligatorio
                ->constrained('proyectos') // tabla a la que se vincula
                ->onDelete('cascade');        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
          
            $table->dropForeign(['id_proyecto']);
            $table->dropColumn('id_proyecto');

        });
    }
};
