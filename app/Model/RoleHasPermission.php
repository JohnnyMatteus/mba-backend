<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    protected $table = 'role_has_permissions';
    public $timestamps = false;
    //protected $guarded = ['id'];

    protected $fillable = [
        'role_id', 'permission_id'
    ];

    public function role()
    {
        return $this->hasMany(Roles::class, 'role_id');
    }
    public function permissions()
    {
        return $this->hasMany(Permissions::class, 'permission_id');
    }
}
