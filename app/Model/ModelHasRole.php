<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    protected $table = 'model_has_roles';
    public $timestamps = false;
    //protected $guarded = ['id'];

    protected $fillable = [
        'role_id', 'model_type', 'model_id'
    ];
}
