<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ordenes_produccion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained()->onDelete('cascade');
            $table->string('estado')->default('pendiente'); // Estado de la orden
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_produccion');
    }
};
