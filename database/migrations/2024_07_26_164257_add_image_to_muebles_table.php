<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToMueblesTable extends Migration
{
    public function up()
    {
        Schema::table('muebles', function (Blueprint $table) {
            $table->string('image')->nullable()->after('tipo_impresion');
        });
    }

    public function down()
    {
        Schema::table('muebles', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
