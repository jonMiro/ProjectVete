<?php

// database/migrations/xxxx_xx_xx_create_consultas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained('animales')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->date('fecha');
            $table->time('hora');
            $table->string('lugar')->nullable();
            $table->float('peso')->nullable();
            $table->string('tipo_animal');
            $table->string('raza')->nullable();
            $table->string('motivo');
            $table->text('anamnesis')->nullable();
            $table->text('examen_fisico')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('observaciones')->nullable();
            $table->float('precio');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
