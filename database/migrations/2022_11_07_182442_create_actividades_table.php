<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id('id_actividad')->autoIncrement();
            
            $table->string('nombre_actividad', 255);
            $table->string('descripcion', 255);
            $table->dateTime('fecha_asignacion', $precision = 0);
            $table->dateTime('fecha_inicio', $precision = 0);
            $table->dateTime('fecha_fin', $precision = 0);
            $table->dateTime('fecha_entrega', $precision = 0);
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_equipo');
            $table->bigInteger('id_proyecto');
            $table->string('estado');
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
        Schema::dropIfExists('actividades');
    }
}
