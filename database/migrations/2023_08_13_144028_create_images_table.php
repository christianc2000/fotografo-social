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
            $table->String('url_low_quality')->nullable();//imagen en baja calidad
            $table->String('tipo', 1); //P=PERFIL,G=FOTO DEL CLIENTE CUANDO COMPRA UNA FOTO,F=FOTO SUBIDA POR EL FOTOGRAFO,E=FOTO SUBIDA EN EL EVENTO
            $table->json('clientes')->nullable();
            $table->unsignedBigInteger('imageable_id')->nullable(); // Eliminamos la restricción de no nulo
            $table->string('imageable_type');
            $table->unsignedInteger('quantity')->default(1);
            $table->foreignId('categoria_id')->nullable()->references('id')->on('categorias');
            $table->foreignId('fotografo_id')->nullable()->references('id')->on('fotografos');
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
