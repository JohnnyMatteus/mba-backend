<?php

namespace App\Model;

use App\Model\Uuid;
use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Periodicidade extends Model
{
    use Uuid;
    protected $table = 'periodicidades';
    protected $guarded = ['id'];

    protected $fillable = [
        'id', 
        'uuid',
        'periodo',
        'tipo',
        'dias',
        'descricao', 
        'created_at',	
        'updated_at'
    ];
}
