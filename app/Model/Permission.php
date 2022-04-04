<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $guarded = ['id'];

    protected $fillable = [
        'id', 'name', 'guard_name', 'created_at', 'updated_at'
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, RoleHasPermission::class, 'permission_id', 'role_id');
    }
    
}
