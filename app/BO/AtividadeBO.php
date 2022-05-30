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
        $objeto->atividades->map(function($item)
        {
            $item->fornecedor_nome = $item->fornecedor->nome;
            $item->comprovante_fiscal = asset("/storage/atividades/arquivo/{$item->comprovante_fiscal}");
            unset($item->fornecedor);
        });
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
        if ($request->hasFile('arquivo'))
        {
            $nameFile = preg_replace('/\s+/', '', time().'.'.$request->arquivo->extension());
            $request->arquivo->storeAs('public/atividades/arquivo', $nameFile);
            $request->merge([
                "comprovante_fiscal" => $nameFile
            ]);
        } 
        $objeto->atividade = (new Atividade())->firstOrCreate([
            'observacao'                       => $request->observacao,
            'data_atividade'                   => $request->data_atividade,
            'data_registro'                    => $request->data_registro,             
            'status'                           => $request->status,        
            'comprovante_fiscal'               => ($request->hasFile('arquivo')) ? $request->comprovante_fiscal : $request->comprovante_fiscal,       
            'id_item_plano_manutencao'         => $request->id_item_plano_manutencao,        
            'id_fornecedor'                    => $request->id_fornecedor       

        ]);
        $objeto->atividade->fornecedor_nome = $objeto->atividade->fornecedor->nome;
        $objeto->atividade->comprovante_fiscal = asset("/storage/atividades/arquivo/{$objeto->atividade->comprovante_fiscal}");
        unset($objeto->atividade->fornecedor);
        return $objeto->atividade;

    }

    public function update($request, $id)
    {
        $objeto = new \stdClass();
        $objeto->atividade = (new Atividade())->find($id);
        if ($request->hasFile('arquivo'))
        {
            $nameFile = preg_replace('/\s+/', '', time().'.'.$request->arquivo->extension());
            $request->arquivo->storeAs('public/atividades/arquivo', $nameFile);
            $request->merge([
                "comprovante_fiscal" => $nameFile
            ]);
        } 
        $objeto->atividade->update([
            'observacao'                       => $request->observacao,
            'data_atividade'                   => $request->data_atividade,
            'data_registro'                    => $request->data_registro,             
            'status'                           => $request->status,        
            'comprovante_fiscal'               => ($request->hasFile('arquivo')) ? $request->comprovante_fiscal : $objeto->atividade->comprovante_fiscal,       
            'id_item_plano_manutencao'         => $request->id_item_plano_manutencao,        
            'id_fornecedor'                    => $request->id_fornecedor    
        ]);    
        return $objeto->atividade;       
    }


    public function destroy($id)
    {
        $objeto = new \stdClass();
        $objeto->atividade = (new Atividade())->find($id);
        Storage::delete("/public/atividades/arquivo/".$objeto->atividade->comprovante_fiscal);
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

    public function estatiscasGeraisMesAtual()
    {       
        return Atividade::estatiscasGeraisMesAtual();
    }

    public function estatiscasGerais()
    {       
        $objeto = new \stdClass();
        $objeto->dados = Atividade::estatiscasGerais();
        $total = 0;
        if (isset($objeto->dados))
        {
            foreach ($objeto->dados as $item)
            {
                $total += $item->total;
            }
            array_push($objeto->dados, (object)['title' => "total", "total" => $total]);
        }
       
        return $objeto->dados;
    }
    

}