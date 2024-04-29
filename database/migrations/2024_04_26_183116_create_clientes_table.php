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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('nombre');
            $table->string('apellido');
            $table->bigInteger('cedula');
            $table->string('departamento');
            $table->string('ciudad');
            $table->string('celular');
            $table->string('correo_electronico');
            $table->boolean('habeas_data')->default(false);
            $table->boolean('winner')->default(false);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
