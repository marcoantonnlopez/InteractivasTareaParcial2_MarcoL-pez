<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('detalle_solicitud', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id'); 
            $table->integer('cantidad'); 
            $table->unsignedBigInteger('idsolicitud'); 
            $table->timestamps();

            // Clave foránea para relacionar con la tabla de productos
            $table->foreign('producto_id')->references('id')->on('productos');
            // Clave foránea para relacionar con la tabla de solicitudes
            $table->foreign('idsolicitud')->references('id')->on('solicitud');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_solicitud');
    }
};

