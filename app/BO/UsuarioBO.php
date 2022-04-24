<?php

namespace App\BO;

use App\Model\Role;
use App\Model\User;
use App\Http\Requests;
use App\Model\Empresa;
use App\Model\Permissions;
use App\Model\ModelHasRole;
use Illuminate\Http\Request;
use App\Model\Empreendimento;
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
            if ($request->hasFile('avatar'))
            {
                $nameFile = preg_replace('/\s+/', '', $request->name.'.'.$request->avatar->extension());
                $request->avatar->storeAs('usuarios/avatar', $nameFile);
                $request->merge([
                    "avatar_url" => $nameFile
                ]);
            }
            $request->merge([ "status" => 'A', "password" => bcrypt("devomudar") ]);
            
            $objeto->usuario = (new User())->create($request->all());
            
            ModelHasRole::create([
                "model_id" =>  $objeto->usuario->id,
                "role_id" => $request->role,
                "model_type" => 'App\Model\User'                
            ]);
            if ($request->has('empreendimentos') && is_array($request->empreendimentos))
            {
                foreach ($request->empreendimentos as $item)
                {
                    $objeto->usuario->empreendimentos()->sync($item);
                }                
            }
            return $objeto->usuario;

        } catch (\Throwable $th) {
            return $th->getMessage(). " - " .$th->getLine();
        }

    }
    public function initialize()
    {
        $objeto = new \stdClass();
        $objeto->usuarios = (new User())->all();
        $objeto->empresas = (new Empresa())->all();
        $objeto->empreendimentos = (new Empreendimento())->all();
        $objeto->roles = (new Role())->all();
        $objeto->usuarios->map(function($item)
        {
            $item->role = (isset($item->roles) && count($item->roles) > 0) ? $item->roles[0]->name : false;
            unset($item->roles);
            return $item->roles;
        });
        return $objeto;
    }
    public function show($user)
    {
        $objeto = new \stdClass();
        $objeto->usuario = $user;
        return $objeto->usuario;
    }
    public function update($request, $id)
    {
        $objeto = new \stdClass();
        try {
            $objeto = new \stdClass();            
            $user = (new User())->find($id);
        
            if ($request->hasFile('avatar'))
            {
                $nameFile = preg_replace('/\s+/', '', $request->name.'.'.$request->avatar->extension());
                $request->avatar->storeAs('usuarios/avatar', $nameFile);
                $request->merge([
                    "avatar_url" => $nameFile
                ]);
            }      
            $objeto->usuario = $user->update($request->all());              
            if ($request->has('role'))
            {
                $objeto->usuario->roles->detach(); 
                ModelHasRole::create([
                    "model_id" =>  $objeto->usuario->id,
                    "role_id" => $request->role,
                    "model_type" => 'App\Model\User'                
                ]);
            }

            if ($request->has('empreendimentos') && is_array($request->empreendimentos))
            {
                $objeto->usuario->empreendimentos()->detach(); 
                foreach ($request->empreendimentos as $item)
                {
                    $objeto->usuario->empreendimentos()->sync($item);
                }                
            }
            return json_encode($request->all());

        } catch (\Throwable $th) {
            return $th->getMessage(). " - " .$th->getLine();
        }

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
        else if ($this->dadosUsuario['user']['role'] == 'Construtora')
        {
            return array([
                "action" => 'read',
                "subject" => 'dashboad-empresa'
            ], [
                "action" => 'read',
                "subject" => 'Public'
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
                    "subject" => ucfirst($item[0]) 
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
        $this->dadosUsuario['user']['id'] = $this->usuario->id;
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