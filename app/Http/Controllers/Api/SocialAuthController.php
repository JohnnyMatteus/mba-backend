<?php

namespace App\Http\Controllers\Api;

use App\BO\SocialAuthBO;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
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


    public function register($provider)
    {
        $authBO = new SocialAuthBO();
        $this->return = $authBO->redirectToProvider($provider);
        
        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
    public function handleProviderCallback($provider)
    {
        $authBO = new SocialAuthBO();
        $this->return = $authBO->handleProviderCallback($provider);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
