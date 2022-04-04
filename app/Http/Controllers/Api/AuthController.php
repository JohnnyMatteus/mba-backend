<?php

namespace App\Http\Controllers\Api;

use App\BO\AuthBO;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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
     * FUNÇÃO RESPONSAVEL PELO CADASTRO DE NOVOS USUÁRIOS, POR PADRÃO É ATRIBUITO 
     * O PAPEL DE VISITANTE ATÉ QUE O CONTATO DO COMERCIAL SEJA AGENDADO.
     * @param   Request  $request  
     *
     * @return  array
     */

    public function register(Request $request)
    {
        $authBO = new AuthBO();
        $this->return = $authBO->cadastrarUsuario($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
    /**
     * LOGIN
     *
     * @param   Request  $request
     *
     * @return  array 
     */
    public function login(Request $request)
    {
        $authBO = new AuthBO();
        $this->return = $authBO->logar($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function forgotPassword(Request $request)
    {
        $authBO = new AuthBO();
        $this->return = $authBO->recuperarSenha($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function validToken(Request $request)
    {
        $authBO = new AuthBO();
        $this->return = $authBO->validarToken($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function registerNewPassword(Request $request)
    {
        $authBO = new AuthBO();
        $this->return = $authBO->registrarSenha($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function logOut()
    {
        $authBO = new AuthBO();
        $this->return = $authBO->logOut();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
