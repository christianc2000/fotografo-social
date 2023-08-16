<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->String('url');
            $table->String('tipo', 1); //P=PERFIL,G=FOTO DEL CLIENTE CUANDO COMPRA UNA FOTO,F=FOTO SUBIDA POR EL FOTOGRAFO,E=FOTO SUBIDA EN EL EVENTO
            $table->json('clientes')->nullable();
            $table->unsignedBigInteger('imageable_id')->nullable(); // Eliminamos la restricción de no nulo
            $table->string('imageable_type');
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
        Schema::dropIfExists('images');
    }
}
