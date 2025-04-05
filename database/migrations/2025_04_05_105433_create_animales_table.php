<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo'); // Especie (perro, gato, etc.)
            $table->string('raza');
            $table->string('sexo')->nullable(); // macho, hembra, otro
            $table->date('fechaNacimiento');
            $table->string('imagen')->nullable();
            $table->text('observaciones')->nullable();

            // Relación con Cliente
            $table->foreignId('cliente_id')->constrained('clientes');

            // Podriem afegir la relació amb el veterinari o auxiliar tb(opcional)
            // $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animales');
    }
};
