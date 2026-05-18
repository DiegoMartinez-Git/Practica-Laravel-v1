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
        Schema::table('perfiles', function (Blueprint $table) {
            $table->string('ruta_avatar')->nullable()->change();
            $table->string('usuario_twitter')->nullable()->change();
            $table->text('biografia')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perfiles', function (Blueprint $table) {
            $table->string('ruta_avatar')->nullable(false)->change();
            $table->string('usuario_twitter')->nullable(false)->change();
            $table->text('biografia')->nullable(false)->change();
        });
    }
};
