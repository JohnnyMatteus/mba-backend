<?php

namespace App\BO;

use App\Model\Empresa;
use App\Model\ItemPlanoManutencao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItensPlanoManutencaoBO
{

    private $prosseguir;
    private $data;
    private $item_plano_manutencao;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->itens = (new ItemPlanoManutencao())->all();  
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
        
        $objeto->item = (new ItemPlanoManutencao())->firstOrCreate([
            'nome'                 => $request->nome,
            'data_inicial'            => $request->data_inicial,
            'data_final'           => $request->data_final,
            'status'           => $request->status,
            'id_plano'           => $request->id_plano,
            'id_periodicidade'           => $request->id_periodicidade,
            'id_sistema'           => $request->id_sistema,
            'id_componente'           => $request->id_componente,
            'id_fornecedor'           => $request->id_fornecedor

        ]);
        return $objeto->item;
    }

    public function update($request, $id)
    {
        $objeto = new \stdClass();
        $objeto->item = (new ItemPlanoManutencao())->find($id);
        $objeto->item->update([
            'nome'                 => $request->nome,
            'data_inicial'            => $request->data_inicial,
            'data_final'           => $request->data_final,
            'status'           => $request->status,
            'id_plano'           => $request->id_plano,
            'id_periodicidade'           => $request->id_periodicidade,
            'id_sistema'           => $request->id_sistema,
            'id_componente'           => $request->id_componente,
            'id_fornecedor'           => $request->id_fornecedor
        ]);    
        return $objeto->item;       
    }


    public function destroy($id)
    {
        $objeto = new \stdClass();
        $objeto->item = (new ItemPlanoManutencao())->find($id);
        return $objeto->item->delete();
    }

    public function create() {}
    public function edit(ItemPlanoManutencao $item)
    {
        return $item;
    }
    public function show(ItemPlanoManutencao $item)
    {
        return $item;
    }

    

}