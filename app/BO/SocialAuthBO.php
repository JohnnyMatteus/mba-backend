<?php

namespace App\BO;

use stdClass;
use Carbon\Carbon;
use App\Model\User;
use App\Http\Requests;
use Illuminate\Support\Str;
use App\Model\SocialAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class SocialAuthBO
{

    private $prosseguir;
    private $data;
    private $auth;
    private $social;
    private $user;

    public function redirectToProvider($provider)
    {
        $objeto = new stdClass;
        $objeto->url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        return $objeto;
    }

    public function handleProviderCallback($provider)
    {        
        try {
            $objeto = new stdClass;
            $dados = Socialite::driver($provider)->stateless()->user();
            if (!$dados)
            {
                $objeto->menssagem = "Oops, aconteceu um erro por aqui, contate o administrador.";
                $objeto->codigo = 2;
                return $objeto;
            }
            $this->user = (new UsuarioBO)->retornaUsuarioPorEmail($dados->getEmail());

            (!$this->user) ? $this->cadastrarUsuario($dados) : $this->cadastrarSocialAccount($provider, $dados);
            return $this->user;
            if (!empty($this->user) && $this->user->status == 'A')
            {
                $objeto->access_token = $this->user->createToken('authToken')->accessToken;
            } 
            /*else if (!empty($this->user) && $this->user->status == 'P') {
                $objeto->menssagem = "Seu cadastro foi efetivado, aguarde o contato do adiministrador para ativar sua senha.";
                $objeto->codigo = 1;
            } else {
                $objeto->menssagem = "Oops, aconteceu um erro por aqui, contate o administrador.";
                $objeto->codigo = 1;
            }*/
            return $objeto;
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    private function cadastrarUsuario($objeto)
    {
        $request = new Request();
        $request->merge([
            'name' => $objeto->getName() ?: $objeto->getNickname(),
            'email' => $objeto->getEmail(),
            'password' => bcrypt("devomudar"),
            'status' => 'A',
            'avatar_url' => $objeto->getAvatar(),
            'id_empresa' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);

        $this->user = (new UsuarioBO)->store($request);
        return $this;
    }

    private function cadastrarSocialAccount($provider, $objeto)
    {

        //Verifica se exite autenticação com o provider enviado
        $this->social = $this->user->socialAccount()->where('provider', $provider)->first();

        //Se não tiver entra neste fluxo, que realiza o cadastro do provider
        if (!$this->social) {
            $array = ([
                'provider' => $provider,
                'provider_user_id' => $objeto->user['id'],
                'id_usuario' => $this->user->id
            ]);
            $this->social = $this->store($array);
        }
        return $this;
    }

    public function store($request): SocialAccount
    {
        $objeto = new \stdClass();
        $objeto->socialAccount = (new SocialAccount())->create($request);
        return $objeto->socialAccount;
    }
}
