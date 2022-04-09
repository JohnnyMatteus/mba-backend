<?php

namespace App\Http\Controllers\Api;

use App\BO\EmpreendimentoBO;
use Illuminate\Http\Request;
use App\Model\Empreendimento;
use App\Http\Controllers\Controller;

class EmpreendimentosController extends Controller
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
    public function initialize()
    {
        /*if (Gate::denies('empreendimento.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empreendimentoBO = new EmpreendimentoBO();
        $this->return = $empreendimentoBO->initialize();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if (Gate::denies('empreendimento.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empreendimentoBO = new EmpreendimentoBO();
        $this->return = $empreendimentoBO->index();

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
        /*if (Gate::denies('empreendimento.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empreendimentoBO = new EmpreendimentoBO();
        $this->return = $empreendimentoBO->create();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*if (Gate::denies('empreendimento.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empreendimentoBO = new EmpreendimentoBO();
        $this->return = $empreendimentoBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Empreendimento  $empreendimento
     * @return \Illuminate\Http\Response
     */
    public function show(Empreendimento $empreendimento)
    {
        /*if (Gate::denies('empreendimento.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empreendimentoBO = new EmpreendimentoBO();
        $this->return = $empreendimentoBO->show($empreendimento);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Empreendimento  $empreendimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Empreendimento $empreendimento)
    {
        /*if (Gate::denies('empreendimento.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empreendimentoBO = new EmpreendimentoBO();
        $this->return = $empreendimentoBO->edit($empreendimento);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Empreendimento  $empreendimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empreendimento $empreendimento)
    {
        /*if (Gate::denies('empreendimento.update'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empreendimentoBO = new EmpreendimentoBO();
        $this->return = $empreendimentoBO->update($request, $empreendimento);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Empreendimento  $empreendimento
     * @return \Illuminate\Http\Response
     */
    public function destroy($empreendimento)
    {
        /*if (Gate::denies('empreendimento.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empreendimentoBO = new EmpreendimentoBO();
        $this->return = $empreendimentoBO->destroy($empreendimento);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
