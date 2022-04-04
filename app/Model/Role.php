<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $table = 'roles';
    protected $guarded = ['id'];

    protected $fillable = [
        'id', 'name', 'guard_name', 'created_at', 'updated_at'
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, RoleHasPermission::class, 'role_id', 'permission_id');
    }
    /**
     * Busca as permissões por nome
     * 
     * @author Johnny Santos <jmatteus20@gmail.com>
    */
    public function getPermissionIdsByName($permissions)
    {
        return Permission::whereIn('name', $permissions)->get()->pluck('id')->toArray();
    }
    /**
     * Adiciona nova permissão ao usuário
     * 
     * @author Johnny Santos <jmatteus20@gmail.com>
    */
    public function givePermissionTo(...$permissions)
    {
        $this->permissions()->attach($this->getPermissionIdsByName($permissions));
    }
}
