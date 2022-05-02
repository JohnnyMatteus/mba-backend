<?php

namespace App\Http\Controllers\Api;

use App\BO\AtividadeBO;
use App\Model\Atividade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AtividadeController extends Controller
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
        /*if (Gate::denies('atividade.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $atividadeBO = new AtividadeBO();
        $this->return = $atividadeBO->index();

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
        /*if (Gate::denies('atividade.store'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $atividadeBO = new AtividadeBO();
        $this->return = $atividadeBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function edit(Atividade $atividade)
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
        /*if (Gate::denies('atividade.update'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $atividadeBO = new AtividadeBO();
        $this->return = $atividadeBO->update($request, $id);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*if (Gate::denies('atividade.destroy'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $atividadeBO = new AtividadeBO();
        $this->return = $atividadeBO->destroy($id);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
