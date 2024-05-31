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
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('paciente_name')->nullable();
            $table->string('email')->nullable();
            $table->string('cep')->nullable();
            $table->string('numero_cel')->nullable();
            $table->string('genero')->nullable();
            $table->string('data_atendimento')->nullable();
            $table->string('queixa')->nullable();
            $table->string('atestado')->nullable();
            $table->string('encaminhamentos')->nullable();
            $table->string('diagnostico')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha');
    }
};
