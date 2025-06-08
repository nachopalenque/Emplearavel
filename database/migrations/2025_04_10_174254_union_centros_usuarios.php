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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_centro')->nullable()->after('id');
            $table->foreign('id_centro')->references('id')->on('centros')->onDelete('set null');
        });    }

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['id_centro']);
        $table->dropColumn('id_centro');
    });
}
};
