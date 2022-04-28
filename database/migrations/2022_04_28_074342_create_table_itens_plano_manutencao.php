<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableItensPlanoManutencao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_plano_manutencao', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->string("nome");
            $table->date("data_inicial");
            $table->date("data_final");

            $table->enum("status", ["A", "I"])->default("A");

            $table->unsignedBigInteger('id_plano');
            $table->unsignedBigInteger('id_periodicidade');
            $table->unsignedBigInteger('id_sistema');
            $table->unsignedBigInteger('id_componente');
            $table->unsignedBigInteger('id_fornecedor')->nullable();
            
            $table->foreign('id_plano')->references('id')->on('planos_manutencao')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_periodicidade')->references('id')->on('periodicidades')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_sistema')->references('id')->on('sistemas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_componente')->references('id')->on('componentes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_fornecedor')->references('id')->on('fornecedores')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('itens_plano_manutencao');
    }
}
