<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_unidad', function (Blueprint $table) {
            $table->increments('idMaterialUnidad');
            $table->integer('cantidad');

            // FK hacia unidades
            $table->unsignedInteger('idUnidad');
            $table->foreign('idUnidad')
                  ->references('idUnidad')
                  ->on('unidades')
                  ->onDelete('cascade');

            // FK hacia materiales (PK de Material es 'codigo' int)
            $table->unsignedInteger('idMaterial');
            $table->foreign('idMaterial')
                  ->references('codigo')
                  ->on('materiales')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_unidad');
    }
};