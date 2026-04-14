<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {

            // 1) Quitar llaves foráneas actuales (si existen)
            // Si te falla aquí, abajo te doy alternativa con el nombre del constraint.
            $table->dropForeign(['creado_por']);
            $table->dropForeign(['actualizado_por']);

            // 2) Crear nuevas FK apuntando a users (Laravel default)
            $table->foreign('creado_por')
                ->references('id')->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('actualizado_por')
                ->references('id')->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {

            $table->dropForeign(['creado_por']);
            $table->dropForeign(['actualizado_por']);

            // (Opcional) volver a como estabas antes:
            $table->foreign('creado_por')
                ->references('id')->on('usuarios')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('actualizado_por')
                ->references('id')->on('usuarios')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }
};