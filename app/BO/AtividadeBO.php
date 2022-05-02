<?php

namespace App\BO;

use App\Model\Empresa;
use App\Model\Atividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AtividadeBO
{

    private $prosseguir;
    private $data;
    private $atividade;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->atividades = (new Atividade())->all();  
        return $objeto;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objeto = new \stdClass();
        
        $objeto->atividade = (new Atividade())->firstOrCreate([
            'observacao'                 => $request->nome,
            'data_atividade'            => $request->data_atividade,
            'data_registro,'           => $request->data_registro,
            'data_execucao,'           => $request->data_execucao,        
            'status,'           => $request->status,        
            'comprovante_fiscal,'           => $request->comprovante_fiscal,        
            'custo_estivmado,'           => $request->custo_estivmado,        
            'custo_real,'           => $request->custo_real,        
            'custo_real,'           => $request->custo_real,        
            'id_item_plano_manutencao,'           => $request->id_item_plano_manutencao,        
            'id_fornecedor,'           => $request->id_fornecedor       

        ]);
        return $objeto->atividade;

    }

    public function update($request, $id)
    {
        $objeto = new \stdClass();
        $objeto->atividade = (new Atividade())->find($id);
        $objeto->atividade->update([
            'observacao'                 => $request->nome,
            'data_atividade'            => $request->data_atividade,
            'data_registro,'           => $request->data_registro,
            'data_execucao,'           => $request->data_execucao,        
            'status,'           => $request->status,        
            'comprovante_fiscal,'           => $request->comprovante_fiscal,        
            'custo_estivmado,'           => $request->custo_estivmado,        
            'custo_real,'           => $request->custo_real,        
            'custo_real,'           => $request->custo_real,        
            'id_item_plano_manutencao,'           => $request->id_item_plano_manutencao,        
            'id_fornecedor,'           => $request->id_fornecedor 
        ]);    
        return $objeto->atividade;       
    }


    public function destroy($id)
    {
        $objeto = new \stdClass();
        $objeto->atividade = (new Atividade())->find($id);
        return $objeto->atividade->delete();
    }

    public function create() {}
    public function edit(Atividade $atividade)
    {
        return $atividade;
    }
    public function show(Atividade $atividade)
    {
        return $atividade;
    }

    

}