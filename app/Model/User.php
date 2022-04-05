<?php

namespace App\Model;

use App\Model\Uuid;
use App\Tenant\TenantModels;
use Laravel\Passport\HasApiTokens; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, TenantModels, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'uuid', 'name', 'email', 'password', 'status', 'id_empresa', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Retorna todos papeis atribuidos ao usuário
     * 
     * @author Johnny Santos <jmatteus20@gmail.com>
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id',);
    }
    /**
     * Retorna todas as permissões atribuidos ao usuário 
     * 
     * @author Johnny Santos <jmatteus20@gmail.com>
    */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'model_has_permissions', 'model_id', 'permission_id');
    }
    /**
     * Verifica se possui o papel
     * 
     * @author Johnny Santos <jmatteus20@gmail.com>
    */
    public function hasRole(...$roles)
    {
        return $this->roles()->whereIn('name', $roles)->count();
    }
    /**
     * Verifica as permissões atribuidas ao usuário
     * 
     * @author Johnny Santos <jmatteus20@gmail.com>
    */
    public function hasPermissions(...$permissions)
    {
        return $this->permissions()->whereIn('name', $permissions)->count() || 
            $this->roles()->whereHas('permissions', function($q) use ($permissions){
                $q->whereIn('name', $permissions);
            })->count(); 
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
    /**
     * Atualiza as permissões do usuário
     * 
     * @author Johnny Santos <jmatteus20@gmail.com>
    */
    public function setPermissionTo(...$permissions)
    {
        $this->permissions()->sync($this->getPermissionIdsByName($permissions));
    }
    /**
     * Remove as permissões do usuário
     * 
     * @author Johnny Santos <jmatteus20@gmail.com>
    */
    public function detachPermissions(...$permissions)
    {
        $this->permissions()->detach($this->getPermissionIdsByName($permissions));
    }

    /**
     * Autenticação via provider
     * 
     * @author Johnny Santos <jmatteus20@gmail.com>
    */
    public function socialAccount()
    {
        return $this->hasMany(SocialAccount::class, 'id_usuario');
    }


}