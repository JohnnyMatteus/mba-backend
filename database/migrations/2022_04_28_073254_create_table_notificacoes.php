<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNotificacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->enum("status", ["A", "I"])->default("A");
            $table->date("data_notificacao");
            $table->unsignedBigInteger('id_empreendimento');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_periodicidade');
            $table->unsignedBigInteger('id_componente');
            
            $table->foreign('id_empreendimento')->references('id')->on('empreendimentos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_periodicidade')->references('id')->on('periodicidades')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_componente')->references('id')->on('componentes')->onUpdate('cascade')->onDelete('cascade');
            
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
        Schema::dropIfExists('notificacoes');
    }
}
