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
        Schema::table('comments', function (Blueprint $table) {
            // Eliminar claves foráneas antiguas
            $table->dropForeign(['entry_id']);
            $table->dropForeign(['spot_id']);
            $table->dropColumn(['entry_id', 'spot_id']);

            // Agregar columnas para polimorfismo
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // Restaurar las columnas antiguas
            $table->foreignId('entry_id')->nullable()->constrained('entries')->onDelete('cascade');
            $table->foreignId('spot_id')->nullable()->constrained('spots')->onDelete('cascade');

            // Eliminar las columnas de polimorfismo
            $table->dropColumn(['commentable_id', 'commentable_type']);
        });
    }
};
