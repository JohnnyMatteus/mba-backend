<?php

namespace App\Traits;
use App\Model\Permissions;
/**
 * 
 */
trait HasPermissions
{
    public function hasPermissionTo(...$permissions)
    {
        return $this->permissions()->whereIn('name', $permissions)->count() || 
        $this->roles()->whereHas('permissions', function($q) use ($permissions){
            $q->whereIn('name', $permissions);
        })->count(); 
    }

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'model_has_permissions');
    }
}
