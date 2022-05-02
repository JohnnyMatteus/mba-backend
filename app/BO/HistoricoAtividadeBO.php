<?php

namespace App\BO;

use App\Model\Empresa;
use App\Model\HistoricoAtividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoricoAtividadeBO
{

    private $prosseguir;
    private $data;
    private $historico_atividade;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->historicoAtividades = (new HistoricoAtividade())->all();  
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
        
        $objeto->historicoAtividade = (new HistoricoAtividade())->firstOrCreate([
            'de'                 => $request->de,
            'para'            => $request->para,
            'id_atividade'           => $request->id_atividade,
            'id_usuario'           => $request->id_usuario

        ]);
        return $objeto->historicoAtividade;
    }

    public function update($request, $id)
    {
        $objeto = new \stdClass();
        $objeto->historicoAtividade = (new HistoricoAtividade())->find($id);
        $objeto->historicoAtividade->update([
            'de'                 => $request->de,
            'para'            => $request->para,
            'id_atividade'           => $request->id_atividade,
            'id_usuario'           => $request->id_usuario
        ]);    
        return $objeto->historicoAtividade;       
    }


    public function destroy($id)
    {
        $objeto = new \stdClass();
        $objeto->historicoAtividade = (new HistoricoAtividade())->find($id);
        return $objeto->historicoAtividade->delete();
    }

    public function create() {}
    public function edit(HistoricoAtividade $historicoAtividade)
    {
        return $historicoAtividade;
    }
    public function show(HistoricoAtividade $historicoAtividade)
    {
        return $historicoAtividade;
    }

    

}