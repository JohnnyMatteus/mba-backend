<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Componentes;
use Illuminate\Http\Request;
use App\BO\ComponentesBO;

class ComponentesController extends Controller
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
        /*if (Gate::denies('componentes.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $componentesBO = new ComponentesBO();
        $this->return = $componentesBO->index();

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
        /*if (Gate::denies('componentes.store'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $componentesBO = new ComponentesBO();
        $this->return = $componentesBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Componentes  $componentes
     * @return \Illuminate\Http\Response
     */
    public function show(Componentes $componentes)
    {
        /*if (Gate::denies('componentes.show'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $componentesBO = new ComponentesBO();
        $this->return = $componentesBO->show($componentes);

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
     * @param  \App\Model\Componentes  $componentes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $componentes)
    {
        /*if (Gate::denies('componentes.update'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $componentesBO = new ComponentesBO();
        $this->return = $componentesBO->update($request, $componentes);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Componentes  $componentes
     * @return \Illuminate\Http\Response
     */
    public function destroy($componentes)
    {
        /*if (Gate::denies('componentes.delete'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $componentesBO = new ComponentesBO();
        $this->return = $componentesBO->destroy($componentes);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
