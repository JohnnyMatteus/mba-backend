<?php

namespace App\Model;

use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Model;


class PlanoManutencao extends Model
{
    use Uuid, TenantModels;
    protected $table = 'planos_manutencao';
    protected $guarded = ['id'];

    protected $fillable = [
        'id',	'uuid',	'nome',	'data_inicial',	'data_final',	'status',	'id_empresa',	'id_empreendimento',	'created_at',	'updated_at'
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'id_empresa');
    }
    public function empreendimento()
    {
        return $this->belongsTo(Empreendimento::class,'id_empreendimento');
    }
    
}
