<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHistoricoAtividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_atividades', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->string("de");
            $table->string("para");
            $table->unsignedBigInteger('id_atividade');            
            $table->unsignedBigInteger('id_usuario');            
            $table->foreign('id_atividade')->references('id')->on('atividades')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('historico_atividades');
    }
}
