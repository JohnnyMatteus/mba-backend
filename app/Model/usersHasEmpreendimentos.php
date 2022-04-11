<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class usersHasEmpreendimentos extends Model
{
    protected $table = 'users_has_empreendimentos';
    public $timestamps = false;
    //protected $guarded = ['id'];

    protected $fillable = [
        'id_user', 'id_empreendimento'
    ];
}
