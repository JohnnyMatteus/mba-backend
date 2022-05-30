<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCollumnTablePlanoAtividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planos_manutencao', function (Blueprint $table) {
            $table->enum("status", ["A", "I", "P", "C"])->default("A")->after("data_final");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planos_manutencao', function (Blueprint $table) {
            //
        });
    }
}
