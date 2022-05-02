<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\BO\HistoricoAtividadeBO;
use App\Model\HistoricoAtividade;
use App\Http\Controllers\Controller;

class HistoricoAtividadeController extends Controller
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
        /*if (Gate::denies('historico-atividade.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $historicoAtividadeBO = new HistoricoAtividadeBO();
        $this->return = $historicoAtividadeBO->index();

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
        /*if (Gate::denies('historico-atividade.store'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $historicoAtividadeBO = new HistoricoAtividadeBO();
        $this->return = $historicoAtividadeBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\HistoricoAtividade  $historicoAtividade
     * @return \Illuminate\Http\Response
     */
    public function show(HistoricoAtividade $historicoAtividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\HistoricoAtividade  $historicoAtividade
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoricoAtividade $historicoAtividade)
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
        /*if (Gate::denies('historico-atividade.update'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $historicoAtividadeBO = new HistoricoAtividadeBO();
        $this->return = $historicoAtividadeBO->update($request, $id);

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
        /*if (Gate::denies('historico-atividade.destroy'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $historicoAtividadeBO = new HistoricoAtividadeBO();
        $this->return = $historicoAtividadeBO->destroy($id);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
