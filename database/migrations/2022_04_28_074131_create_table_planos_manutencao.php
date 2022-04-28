<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePlanosManutencao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planos_manutencao', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->string("nome");
            $table->date("data_inicial");
            $table->date("data_final");

            $table->enum("status", ["A", "I"])->default("A");

            $table->unsignedBigInteger('id_empresa');
            $table->unsignedBigInteger('id_empreendimento');
            
            $table->foreign('id_empresa')->references('id')->on('empresas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_empreendimento')->references('id')->on('empreendimentos')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('planos_manutencao');
    }
}
