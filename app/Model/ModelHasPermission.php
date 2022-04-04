<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ModelHasPermission extends Model
{
    protected $table = 'model_has_permissions';
    public $timestamps = false;
    //protected $guarded = ['id'];

    protected $fillable = [
        'permission_id', 'model_type', 'model_id'
    ];
}
