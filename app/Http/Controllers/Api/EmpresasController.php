<?php

namespace App\Http\Controllers\Api;

use App\BO\EmpresaBO;
use App\Model\Empresa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpresasController extends Controller
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
        /*if (Gate::denies('empresa.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empresaBO = new EmpresaBO();
        $this->return = $empresaBO->initialize();

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
        /*if (Gate::denies('empresa.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empresaBO = new EmpresaBO();
        $this->return = $empresaBO->index();

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
        /*if (Gate::denies('empresa.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empresaBO = new EmpresaBO();
        $this->return = $empresaBO->create();

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
        /*if (Gate::denies('empresa.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empresaBO = new EmpresaBO();
        $this->return = $empresaBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show($empresa)
    {
        /*if (Gate::denies('empresa.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empresaBO = new EmpresaBO();
        $this->return = $empresaBO->show($empresas);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit($empresa)
    {
        /*if (Gate::denies('empresa.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empresaBO = new EmpresaBO();
        $this->return = $empresaBO->edit($empresa);

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
     * @param  \App\Model\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $empresa)
    {
        /*if (Gate::denies('empresa.update'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empresaBO = new EmpresaBO();
        $this->return = $empresaBO->update($request, $empresa);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa)
    {
        /*if (Gate::denies('empresa.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $empresaBO = new EmpresaBO();
        $this->return = $empresaBO->destroy($empresa);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
    public function exportCSV()
    {
        $empresaBO = new EmpresaBO();
        $this->return = $empresaBO->exportCSV();

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
        $empresaBO = new EmpresaBO();
        $this->return = $empresaBO->exportPDF();

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao baixar o arquivo";
            return \Helpers::collection(false, $this->code, $this->message);
        }
        return $this->return;
    }
}
