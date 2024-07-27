<?php
// database/migrations/xxxx_xx_xx_xxxxxx_update_muebles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMueblesTable extends Migration
{
    public function up()
    {
        Schema::table('muebles', function (Blueprint $table) {
            // Eliminar la columna existente de medidas
            $table->dropColumn('medidas');

            // Agregar nuevas columnas para base, altura y fondo
            $table->integer('base')->after('cantidad_muebles');
            $table->integer('altura')->after('base');
            $table->integer('fondo')->after('altura');
        });
    }

    public function down()
    {
        Schema::table('muebles', function (Blueprint $table) {
            // Volver a agregar la columna de medidas
            $table->string('medidas')->after('cantidad_muebles');

            // Eliminar las columnas base, altura y fondo
            $table->dropColumn(['base', 'altura', 'fondo']);
        });
    }
}
