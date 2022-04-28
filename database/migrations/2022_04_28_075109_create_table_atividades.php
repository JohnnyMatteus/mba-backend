<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAtividades extends Migration
{
    /**
     * NOTE
     * Descrição dos status
     * - A: Indica uma atividade dentro do prazo, ainda não registrada.
     * - P: Indica uma atividade dentro do prazo, cujo registro já foi efetuado, mas ainda falta enviar a Nota Fiscal.
     * - D: Indica uma atividade finalizada, com a Nota Fiscal enviada.
     * - I: Indica uma atividade cujo prazo venceu. Neste caso, não é mais possível efetuar qualquer registro ou envio de Nota Fiscal.
     */
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->string("observacao");
            
            $table->date("data_atividade");
            $table->date("data_registro");
            $table->date("data_execucao");

            $table->enum("status", ["A", "P", "D", "I"])->default("A");
            $table->enum("comprovante_fiscal", ["A", "I"])->default("I");
            $table->double("custo_estivmado");
            $table->double("custo_real");

            $table->unsignedBigInteger('id_item_plano_manutencao');            
            $table->unsignedBigInteger('id_fornecedor')->nullable();
            
            $table->foreign('id_item_plano_manutencao')->references('id')->on('itens_plano_manutencao')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('atividades');
    }
}
