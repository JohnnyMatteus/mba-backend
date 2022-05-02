<?php

namespace App\BO;

use App\Model\Empresa;
use App\Model\ArquivoAtividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArquivosAtividadesBO
{

    private $prosseguir;
    private $data;
    private $arquivo_atividade;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->arquivoAtividades = (new ArquivoAtividade())->all();  
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
        
        $objeto->arquivoAtividade = (new ArquivoAtividade())->firstOrCreate([
            'arquivo'                 => $request->arquivo,
            'tipo'            => $request->tipo,
            'id_atividade'           => $request->id_atividade,     
            'id_usuario'               => $request->id_usuario        
        ]);
        return $objeto->arquivoAtividade;
    }

    public function update($request, $id)
    {
        $objeto = new \stdClass();
        $objeto->arquivoAtividade = (new ArquivoAtividade())->find($id);
        $objeto->arquivoAtividade->update([
            'arquivo'                 => $request->arquivo,
            'tipo'            => $request->tipo,
            'id_atividade'           => $request->id_atividade,     
            'id_usuario'               => $request->id_usuario
        ]);    
        return $objeto->arquivoAtividade;       
    }

    public function destroy($id)
    {
        $objeto = new \stdClass();
        $objeto->arquivoAtividade = (new ArquivoAtividade())->find($id);
        return $objeto->arquivoAtividade->delete();
    }

    public function create() {}
    public function edit(ArquivoAtividade $arquivoAtividade)
    {
        return $arquivoAtividade;
    }
    public function show(ArquivoAtividade $arquivoAtividade)
    {
        return $arquivoAtividade;
    }

    

}