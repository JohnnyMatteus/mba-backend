<?php

namespace App\BO;

use App\Model\Empresa;
use App\Model\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FornecedorBO
{

    private $prosseguir;
    private $data;
    private $fornecedor;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->fornecedor = (new Fornecedor())->all();  
        $objeto->empresas   = (new Empresa())->all();
        return $objeto;
    }
    public function initialize()
    {
        $objeto = new \stdClass();
        $objeto->fornecedor = (new Fornecedor())->all(); 
        $objeto->empresas   = (new Empresa())->all();
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
        
        $objeto->fornecedor = (new Fornecedor())->firstOrCreate([
            'nome'                 => $request->nome,
            'email'                => $request->email,
            'responsavel'          => $request->responsavel,
            'id_empresa'           => $request->id_empresa, 
            'status'               => "A"
        ]);
        return $objeto->fornecedor;
    }

    public function update($request, $fornecedor)
    {
        $objeto = new \stdClass();
        $objeto->fornecedor = (new Fornecedor())->find($fornecedor);
        $objeto->fornecedor->update([
            'nome'                 => $request->nome,
            'email'                => $request->email,
            'responsavel'          => $request->responsavel, 
            'id_empresa'           => $request->id_empresa,
            'status'               => $request->status
        ]);    
        return $objeto->fornecedor;       
    }


    public function destroy($fornecedor)
    {
        $objeto = new \stdClass();
        $objeto->fornecedor = (new Fornecedor())->find($fornecedor);
        return $objeto->fornecedor->delete();
    }

    public function create() {}
    public function edit(Fornecedor $fornecedor) {}
    public function show(Fornecedor $fornecedor) {}

    

}