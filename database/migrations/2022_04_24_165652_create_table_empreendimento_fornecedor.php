<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmpreendimentoFornecedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empreendimento_has_fornecedor', function (Blueprint $table) {
            $table->unsignedBigInteger('id_empreendimento');
            $table->unsignedBigInteger('id_fornecedor');
            $table->foreign('id_empreendimento')->references('id')->on('empreendimentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_fornecedor')->references('id')->on('fornecedores')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empreendimento_has_fornecedor');
    }
}
