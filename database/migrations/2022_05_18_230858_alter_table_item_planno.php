<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableItemPlanno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itens_plano_manutencao', function (Blueprint $table) {
            $table->dropColumn('data_inicial');
            $table->dropColumn('data_final');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itens_plano_manutencao', function (Blueprint $table) {            

        });
    }
}
