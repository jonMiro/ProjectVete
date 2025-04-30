<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->date('fecha');
            $table->timestamp('start');
            $table->timestamp('end')->nullable();
            $table->enum('tipo', ['peluqueria', 'pedicura', 'lavado', 'cita veterinaria', 'vacunacion']);
            $table->text('descripcion')->nullable();
            $table->string('comentario')->nullable();
            $table->decimal('precio', 8, 2)->nullable(); // <-- Aquí el cambio
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}

