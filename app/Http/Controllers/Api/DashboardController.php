<?php

namespace App\Http\Controllers\Api;

use App\BO\DashboardBO;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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
    public function painelAdministrativo()
    {
        /*if (Gate::denies('painel.administrativo'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $dashboardBO = new DashboardBO();
        $this->return = $dashboardBO->painelAdministrativo();

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
    public function painelEmpresa()
    {
        /*if (Gate::denies('painel.administrativo'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $dashboardBO = new DashboardBO();
        $this->return = $dashboardBO->painelEmpresa();

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
    public function painelSindico()
    {
        /*if (Gate::denies('painel.administrativo'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $dashboardBO = new DashboardBO();
        $this->return = $dashboardBO->painelSindico();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
