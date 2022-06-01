<?php

namespace App\Model;

use App\Model\Uuid;
use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Empreendimento extends Model
{
    use TenantModels, Uuid;
    protected $table = 'empreendimentos';
    protected $guarded = ['id'];

    protected $fillable = [
        'id', 
        'uuid',
        'id_empresa',
        'name',
        'status', 
        'fone',
        'logo', 
        'description', 
        'endereco', 
        'slug',
        'created_at',	
        'updated_at'
    ];
}
