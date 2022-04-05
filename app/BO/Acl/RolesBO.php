<?php

namespace App\BO\Acl;

use App\Model\Permission;
use App\Model\Role;
use Illuminate\Http\Request;

class RolesBO
{

    private $prosseguir;
    private $role;

    public function initialize()
    {
        $objeto = new \stdClass();
        $objeto->roles = (new Role())->all();    
        $objeto->roles->map(function($item) {       
            $item->permissoes = $item->permissions->flatten()->pluck('name')->toArray();
            unset($item->permissions);
            return $item->permissoes;
        });
        $objeto->permissions = (new Permission())->all();

        return $objeto;
    }
    public function store($request)
    {
        $objeto = new \stdClass();

        $array = [
            'name' => $request->name,
            'guard_name' => 'api'
        ];
        
        $objeto->role = (new Role())->firstOrCreate($array);
       
        if (isset($request->permissions))
        {
            $this->syncPermissions($objeto->role, $request);
        }

        return $objeto->role;
    }
    public function update($request, $role): bool
    {
        try {
            $objeto = new \stdClass();
            $array = [
                'name' => $request->name,
                'guard_name' => 'api'
            ];
            $objeto->role = $role->update($array);

            $this->syncPermissions($role, $request);
            return true;

        } catch (\Throwable $th) {
            return false;
        }
    }
    private function syncPermissions($role, $request)
    {   
        try {
            $role->permissions()->detach();   
            $permissoes = array_unique($request->permissions);
            foreach ($permissoes as $permission)
            {         
                $role->givePermissionTo($permission);
            }
            $role->permissions;  
            return $this;
        } catch (\Throwable $th) {
            return $this;   
        }    
    }
    public function destroy($role): bool
    {
        return $role->delete();
    }
}