<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToMueblesTable extends Migration
{
    public function up()
    {
        Schema::table('muebles', function (Blueprint $table) {
            if (!Schema::hasColumn('muebles', 'tipo_mueble')) {
                $table->string('tipo_mueble');
            }
            if (!Schema::hasColumn('muebles', 'cantidad_muebles')) {
                $table->integer('cantidad_muebles');
            }
            if (!Schema::hasColumn('muebles', 'base')) {
                $table->decimal('base', 8, 2);
            }
            if (!Schema::hasColumn('muebles', 'altura')) {
                $table->decimal('altura', 8, 2);
            }
            if (!Schema::hasColumn('muebles', 'fondo')) {
                $table->decimal('fondo', 8, 2);
            }
            if (!Schema::hasColumn('muebles', 'maquina')) {
                $table->string('maquina');
            }
            if (!Schema::hasColumn('muebles', 'tipo_impresion')) {
                $table->string('tipo_impresion');
            }
            if (!Schema::hasColumn('muebles', 'acabado')) {
                $table->string('acabado')->nullable();
            }
            if (!Schema::hasColumn('muebles', 'Nota')) {
                $table->text('Nota')->nullable();
            }
            if (!Schema::hasColumn('muebles', 'Pais')) {
                $table->string('Pais')->nullable();
            }
            if (!Schema::hasColumn('muebles', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('muebles', function (Blueprint $table) {
            $table->dropColumn([
                'tipo_mueble',
                'cantidad_muebles',
                'base',
                'altura',
                'fondo',
                'maquina',
                'tipo_impresion',
                'acabado',
                'Nota',
                'Pais',
                'image',
            ]);
        });
    }
}
