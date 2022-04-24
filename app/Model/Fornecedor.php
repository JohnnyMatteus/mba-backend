<?php

namespace App\Model;

use App\Model\Uuid;
use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use TenantModels, Uuid;
    protected $table = 'fornecedores';
    protected $guarded = ['id'];

    protected $fillable = [
        'id', 
        'uuid',
        'nome',
        'email',
        'responsavel',
        'status', 
        'created_at',	
        'updated_at'
    ];
}
