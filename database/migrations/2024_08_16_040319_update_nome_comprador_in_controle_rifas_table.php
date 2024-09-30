<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNomeCompradorInControleRifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controle_rifas', function (Blueprint $table) {
            $table->string('nome_comprador')->nullable()->change();
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
            $table->string('nome_comprador')->nullable(false)->change();
        });
    }
}
