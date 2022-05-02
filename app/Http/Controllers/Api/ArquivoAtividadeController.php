<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\ArquivoAtividade;
use App\BO\ArquivosAtividadesBO;
use App\Http\Controllers\Controller;

class ArquivoAtividadeController extends Controller
{
    private $return;
    private $code;
    private $message;

    public function __construct()
    {
        $this->return  = false;
        $this->code    = config('httpstatus.success.ok');
        $this->message = null;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if (Gate::denies('arquivo-atividade.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $arquivosAtividadesBO = new ArquivosAtividadesBO();
        $this->return = $arquivosAtividadesBO->index();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*if (Gate::denies('arquivo-atividade.store'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $arquivosAtividadesBO = new ArquivosAtividadesBO();
        $this->return = $arquivosAtividadesBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ArquivoAtividade  $arquivoAtividade
     * @return \Illuminate\Http\Response
     */
    public function show(ArquivoAtividade $arquivoAtividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ArquivoAtividade  $arquivoAtividade
     * @return \Illuminate\Http\Response
     */
    public function edit(ArquivoAtividade $arquivoAtividade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*if (Gate::denies('arquivo-atividade.update'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $arquivosAtividadesBO = new ArquivosAtividadesBO();
        $this->return = $arquivosAtividadesBO->update($request, $id);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*if (Gate::denies('arquivo-atividade.destroy'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $arquivosAtividadesBO = new ArquivosAtividadesBO();
        $this->return = $arquivosAtividadesBO->destroy($id);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
