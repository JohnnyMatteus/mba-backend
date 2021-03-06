<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePeriodicidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodicidades', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->string("nome");
            $table->string("periodo");
            $table->string("tipo");
            $table->string("dias");
            $table->string("descricao");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodicidades');
    }
}
