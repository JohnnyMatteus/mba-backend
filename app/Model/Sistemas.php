<?php

namespace App\Model;

use App\Model\Uuid;
use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Sistemas extends Model
{
    use TenantModels, Uuid;
    protected $table = 'sistemas';
    protected $guarded = ['id'];

    protected $fillable = [
        'id', 
        'uuid',
        'nome',
        'descricao',
        'id_empresa',
        'status', 
        'created_at',	
        'updated_at'
    ];
    public function empresa()
    {
        return $this->hasMany(Empresa::class,'id_empresa');
    }
}
