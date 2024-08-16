<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDataCompraNullableInControleRifas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controle_rifas', function (Blueprint $table) {
            // Torna a coluna 'data_compra' opcional (NULL)
            $table->timestamp('data_compra')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('controle_rifas', function (Blueprint $table) {
            // Reverte a coluna 'data_compra' para não permitir NULL
            $table->timestamp('data_compra')->nullable(false)->change();
        });
    }
}
