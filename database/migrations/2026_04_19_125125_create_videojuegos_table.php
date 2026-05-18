<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('videojuegos', function (Blueprint $table) {

            $table->id();
            $table->string('titulo')->unique();
             $table->string('categoria');
             $table->string('desarrollador');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videojuegos');
    }
};
/*    {
        Schema::create('ecosistemas_laborales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modulo_id')
                ->constrained('modulos')
                ->cascadeOnDelete();
            $table->string('nombre');
            $table->string('codigo', 20)->unique();   // Ej: "0614-TBM"
            $table->text('descripcion')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        }); */
/*     VIDEOJUEGOS {
        bigint id PK
        varchar titulo UK
        varchar categoria
        varchar desarrollador
        timestamp created_at
        timestamp updated_at
    } */
