<?php

namespace App\BO;

use App\Model\Empresa;
use App\Model\PlanoManutencao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlanoManutencaoBO
{

    private $prosseguir;
    private $data;
    private $componente;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->planos = (new PlanoManutencao())->all();  
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
        
        $objeto->plano = (new PlanoManutencao())->firstOrCreate([
            'nome'                  => $request->nome,
            'data_inicial'          => $request->data_inicial,
            'data_final'            => $request->data_final,        
            'status'                => $request->status,        
            'id_empresa'            => $request->id_empresa,        
            'id_empreendimento'     => $request->id_empreendimento        
        ]);
        return $objeto->plano;        
    }

    public function update($request, $componentes)
    {
        $objeto = new \stdClass();
        $objeto->plano = (new PlanoManutencao())->find($componentes);
        $objeto->plano->update([
            'nome'                 => $request->nome,
            'data_inicial'            => $request->data_inicial,
            'data_final'           => $request->data_final,        
            'status'           => $request->status,        
            'id_empresa'           => $request->id_empresa,        
            'id_empreendimento'           => $request->id_empreendimento  
        ]);    
        return $objeto->plano;       
    }


    public function destroy($id)
    {
        $objeto = new \stdClass();
        $objeto->plano = (new PlanoManutencao())->find($id);
        return $objeto->plano->delete();
    }

    public function create() {}
    public function edit(PlanoManutencao $plano)
    {
        return $plano;
    }
    public function show(PlanoManutencao $plano)
    {
        return $plano;
    }

    

}