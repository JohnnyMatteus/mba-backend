<?php

namespace App\Http\Controllers\Api;

use App\Model\User;
use App\BO\UsuarioBO;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
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
    public function initialize()
    {
        /*if (Gate::denies('empreendimento.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->initialize();

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
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->dadosUsuario();

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
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->show($user);

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
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->update($request, $user);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->destroy($user);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function exportCSV()
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->exportCSV();

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao baixar o arquivo";
            return \Helpers::collection(false, $this->code, $this->message);
        }
        return $this->return;
    }
    public function exportPDF()
    {
        $usuarioBO = new UsuarioBO();
        $this->return = $usuarioBO->exportPDF();

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao baixar o arquivo";
            return \Helpers::collection(false, $this->code, $this->message);
        }
        return $this->return;
    }
}
