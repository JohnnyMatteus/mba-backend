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

        $objeto->roles->map(function($item, $key) {         
            return  $item->permissions = $item->with('permissions')->get()->pluck('permissions')->flatten()->pluck('name')->toArray();
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
    private function syncPermissions($role, $request)
    {         
        $role->permissions()->detach();          
        foreach ($request->permissions as $permission)
        {         
            $role->givePermissionTo($permission);
        }
        $role->permissions;
            
        return $this;
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
    public function destroy($role): bool
    {
        return $role->delete();
    }
}