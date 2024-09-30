<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataSorteioAndNumeroSorteadoToRifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rifas', function (Blueprint $table) {
            $table->timestamp('data_sorteio')->nullable()->after('total_rifas');
            $table->integer('numero_sorteado')->nullable()->after('data_sorteio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rifas', function (Blueprint $table) {
            $table->dropColumn('data_sorteio');
            $table->dropColumn('numero_sorteado');
        });
    }
}
