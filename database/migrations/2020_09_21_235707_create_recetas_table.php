<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_recetas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('ingredientes');
            $table->text('preparacion');
            $table->string('imagen');
            $table->foreignId('user_id')->references('id')->on('users')->comment('El usuario que crea la receta');
            $table->foreignId('categoria_id')->references('id')->on('categoria_recetas')->comment('la categoria de la receta');
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
        //Schema::disableForeignKeyConstraints();
        /*este codigo es util para cuando por error no se a asignado bien una columna y se quiere hacer un rollback a la migración y presenta conflictos
    por tener llaves foraneas, entonces con este se deshabilitan las foraneas para hacer las correspondientes actualizaciones
    a las tablas de la base de datos*/
        Schema::dropIfExists('categoria_receta');
        Schema::dropIfExists('recetas');
    }
}
