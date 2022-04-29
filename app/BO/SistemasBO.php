<?php

namespace App\BO;

use App\Model\Empresa;
use App\Model\Sistemas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SistemasBO
{

    private $prosseguir;
    private $data;
    private $sistemas;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->sistemas = (new Sistemas())->all();  
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
        
        $objeto->sistema = (new Sistemas())->firstOrCreate([
            'nome'                 => $request->nome,
            'descricao'            => $request->descricao,
            'id_empresa'           => $request->id_empresa        
        ]);
        return $objeto->sistema;
    }

    public function update($request, $id)
    {
        $objeto = new \stdClass();
        $objeto->sistema = (new Sistemas())->find($id);
        $objeto->sistema->update([
            'nome'                 => $request->nome,
            'descricao'            => $request->descricao,
            'id_empresa'           => $request->id_empresa,     
            'status'               => $request->status
        ]);    
        return $objeto->sistema;       
    }


    public function destroy($id)
    {
        $objeto = new \stdClass();
        $objeto->sistema = (new Sistemas())->find($id);
        return $objeto->sistema->delete();
    }

    public function create() {}
    public function edit(Sistemas $sistema)
    {
        return $sistema;
    }
    public function show(Sistemas $sistema)
    {
        return $sistema;
    }

    

}