<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVinculacionClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculacion_clientes', function (Blueprint $table) {
            $table->id();
            $table->boolean('assistance')->default(false); //verifica si asistió
            $table->string('qr_assistance')->nullable(); //qr para verificar que está invitado
            $table->dateTime('assistance_date')->nullable(); //fecha de asistencia
            $table->dateTime('accept_date'); //fecha en la que se acepta la invitación
            $table->foreignId('cliente_id')->references('id')->on('clientes');
            $table->foreignId('evento_id')->references('id')->on('eventos');
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
        Schema::dropIfExists('vinculacion_clientes');
    }
}
