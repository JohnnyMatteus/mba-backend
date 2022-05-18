<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItemPlanoManutencao extends Model
{
    use Uuid;
    protected $table = 'itens_plano_manutencao';
    protected $guarded = ['id'];

    protected $fillable = [
        'id',	'uuid',	'nome',	'data_inicial',	'data_final',	'status',	'id_plano',	'id_periodicidade',	'id_sistema',	'id_componente',	'id_fornecedor',	'created_at',	'updated_at'
    ];
    public function plano()
    {
        return $this->belongsTo(PlanoManutencao::class,'id_plano');
    }
    public function sistemas()
    {
        return $this->belongsTo(Sistemas::class,'id_sistema');
    }
    public function periodicidades()
    {
        return $this->belongsTo(Periodicidade::class,'id_periodicidade');
    }
    public function componentes()
    {
        return $this->belongsTo(Componentes::class,'id_componente');
    }
    public function fornecedores()
    {
        return $this->belongsTo(Fornecedor::class,'id_fornecedor');
    }
}
