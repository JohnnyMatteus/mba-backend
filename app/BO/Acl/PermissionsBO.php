<?php

namespace App\BO\Acl;

use App\Model\Permission;
use Illuminate\Http\Request;

class PermissionsBO
{

    private $prosseguir;
    private $permission;

    public function initialize()
    {
        $objeto = new \stdClass();

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
        $objeto->permission = (new Permission())->firstOrCreate($array);
    
        return $objeto->permission;
    }
    public function update($request, $permission): bool
    {
        try {
            $objeto = new \stdClass();
            $array = [
                'name' => $request->name,
                'guard_name' => 'api'
            ];
            $objeto->permission = $permission->update($array);
            return true;

        } catch (\Throwable $th) {
            return false;
        }
    }
    public function destroy($permission): bool
    {
        return $permission->delete();
    }
}