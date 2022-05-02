<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\BO\ItensPlanoManutencaoBO;
use App\Model\ItemPlanoManutencao;
use App\Http\Controllers\Controller;

class ItemPlanoManutencaoController extends Controller
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
        /*if (Gate::denies('item-manutencao.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $itemPlanoManutencaoBO = new ItensPlanoManutencaoBO();
        $this->return = $itemPlanoManutencaoBO->index();

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
        /*if (Gate::denies('item-manutencao.store'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $itemPlanoManutencaoBO = new ItensPlanoManutencaoBO();
        $this->return = $itemPlanoManutencaoBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ItemPlanoManutencao  $itemPlanoManutencao
     * @return \Illuminate\Http\Response
     */
    public function show(ItemPlanoManutencao $itemPlanoManutencao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ItemPlanoManutencao  $itemPlanoManutencao
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemPlanoManutencao $itemPlanoManutencao)
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
        /*if (Gate::denies('item-manutencao.update'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $itemPlanoManutencaoBO = new ItensPlanoManutencaoBO();
        $this->return = $itemPlanoManutencaoBO->update($request, $id);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ItemPlanoManutencao  $itemPlanoManutencao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*if (Gate::denies('item-manutencao.destroy'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $itemPlanoManutencaoBO = new ItensPlanoManutencaoBO();
        $this->return = $itemPlanoManutencaoBO->destroy($id);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
