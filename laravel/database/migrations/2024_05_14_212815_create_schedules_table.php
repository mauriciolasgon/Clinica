<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('psicologa_id')->constrained('users')->onDelete('cascade');
            $table->date('data');
            $table->time('horario');
            $table->time('tempo_sessao');
            $table->text('observacoes')->nullable();
            $table->boolean('ocupado')->default(false);
            $table->foreignId('ficha_id')->nullable()->constrained('fichas')->onDelete('cascade');
            $table->integer('chegada')->nullable()->default(0);
        
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
