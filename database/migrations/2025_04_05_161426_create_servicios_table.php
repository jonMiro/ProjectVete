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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auxiliar_id')->constrained('auxiliares')->onDelete('cascade'); // Relación con auxiliares
            $table->foreignId('animal_id')->constrained('animales')->onDelete('cascade'); // Relación con animales
            $table->string('tipo_servicio'); //Peluqueria, pedicura, lavado, revisión...
            $table->text('descripcion');
            $table->integer('duracion');
            $table->decimal('precio', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
