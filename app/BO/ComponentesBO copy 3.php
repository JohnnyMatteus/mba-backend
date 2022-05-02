<?php

namespace App\BO;

use App\Model\Empresa;
use App\Model\Componentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComponentesBO
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
        $objeto->componentes = (new Componentes())->all();  
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
        
        $objeto->componente = (new Componentes())->firstOrCreate([
            'nome'                 => $request->nome,
            'descricao'            => $request->descricao,
            'id_empresa'           => $request->id_empresa        
        ]);
        return $objeto->componente;
    }

    public function update($request, $componentes)
    {
        $objeto = new \stdClass();
        $objeto->componente = (new Componentes())->find($componentes);
        $objeto->componente->update([
            'nome'                 => $request->nome,
            'descricao'            => $request->descricao,
            'id_empresa'           => $request->id_empresa,     
            'status'               => $request->status
        ]);    
        return $objeto->componente;       
    }


    public function destroy($componente)
    {
        $objeto = new \stdClass();
        $objeto->componente = (new Componentes())->find($componente);
        return $objeto->componente->delete();
    }

    public function create() {}
    public function edit(Componentes $componente)
    {
        return $componente;
    }
    public function show(Componentes $componente)
    {
        return $componente;
    }

    

}