<?php

namespace App\BO;

use App\Model\User;
use App\Http\Requests;
use App\Model\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class UsuarioBO
{

    private $prosseguir;
    private $usuario;
    private $dadosUsuario;

    public function dadosUsuario()
    {
        $this->retornaDadosUsuario();
        return $this->dadosUsuario;
    }
    public function store($request)
    {
        try {
            $objeto = new \stdClass();
            $objeto->usuario = (new User())->create($request);
            return $objeto->usuario;
        } catch (\Throwable $th) {
            return false;
        }

    }
    public function show($user)
    {
        $objeto = new \stdClass();
        $objeto->usuario = $user;
        return $objeto->usuario;
    }
    public function update($request, $user)
    {
        $objeto = new \stdClass();
        $objeto->usuario = $user->update($request);
        return $objeto->usuario;
    }
    public function destroy($user)
    {
        $objeto = new \stdClass();
        $user->delete();
        return true;
    }
    private function retornaPermissions()
    {
        $this->dadosUsuario['user']['ability'] = $this->retornaArrayPemissions();
        return $this;
    }
    private function retornaArrayPemissions()
    {
        if ($this->dadosUsuario['user']['role'] == 'Administrador')
        {
            return array([
                "action" => 'manage',
                "subject" => 'all'
            ]);
        }
        else {
            return $this->normalizarListaPermissoes();
        }
    }
    private function normalizarListaPermissoes()
    {
        $data = array();
        if (count($this->usuario->roles[0]->permissions) > 0)
        {
            $permissoes = $this->usuario->role[0]->permissions;            
            foreach ($permissoes as $permissao)
            {
                $item = explode($permissao, '.');
                array_push($data,  [
                    "action" => $item[1],
                    "subject" => $item[0]
                ]);
            }            
        }
        return $data;
    }
    private function retornaRole()
    {
        $this->dadosUsuario['user']['role'] = $this->usuario->roles[0]->name;
        return $this;
    }
    private function verificaDadosUsuario()
    {
        $this->dadosUsuario['user']['name'] = $this->usuario->name;
        $this->dadosUsuario['user']['email'] = $this->usuario->email;
        $this->dadosUsuario['user']['id_empresa'] = $this->usuario->id_empresa;
        $this->dadosUsuario['user']['status'] = $this->usuario->status;  
        $this->dadosUsuario['user']['avatar'] = "";     
        $this->retornaRole()
        ->retornaPermissions();
        return $this;

    }
    private function retornaDadosUsuario()
    {
        $user = Auth::user();
        $this->usuario = $user;
        $this->verificaDadosUsuario();
        return $this->dadosUsuario;
    }
    public function retornaUsuarioPorEmail($email)
    {
        return User::where([
            ['email', '=', $email],
            ['status', '!=', 'I']
        ])->first();
    }
}