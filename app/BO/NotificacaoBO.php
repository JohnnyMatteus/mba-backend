<?php

namespace App\BO;

use App\Model\Empresa;
use App\Model\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotificacaoBO
{

    private $prosseguir;
    private $data;
    private $notificacao;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->notificacoes = (new Notificacao())->all();  
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
        
        $objeto->notifcacao = (new Notificacao())->firstOrCreate([
            'data_notificacao'      => $request->data_notificacao,
            'id_empreendimento'     => $request->id_empreendimento,
            'id_usuario'            => $request->id_usuario,        
            'id_periodicidade'      => $request->id_periodicidade,        
            'id_componente'         => $request->id_componente        
        ]);


        return $objeto->notifcacao;
    }

    public function update($request, $id)
    {
        $objeto = new \stdClass();
        $objeto->notifcacao = (new Notificacao())->find($id);
        $objeto->notifcacao->update([
            'data_notificacao'      => $request->data_notificacao,
            'id_empreendimento'     => $request->id_empreendimento,
            'id_usuario'            => $request->id_usuario,        
            'id_periodicidade'      => $request->id_periodicidade,        
            'id_componente'         => $request->id_componente  
        ]);    
        return $objeto->notifcacao;       
    }


    public function destroy($id)
    {
        $objeto = new \stdClass();
        $objeto->notificacao = (new Notificacao())->find($id);
        return $objeto->notificacao->delete();
    }

    public function create() {}
    public function edit(Notificacao $notificacao)
    {
        return $notificacao;
    }
    public function show(Notificacao $notificacao)
    {
        return $notificacao;
    }

    

}