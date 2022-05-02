<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    use Uuid;
    protected $table = 'atividades';
    protected $guarded = ['id'];

    protected $fillable = [
        'id',	
        'uuid',	
        'observacao',	
        'data_atividade',	
        'data_registro',	
        'data_execucao',	
        'status',	
        'comprovante_fiscal',	
        'custo_estivmado',
        'custo_real',	
        'id_item_plano_manutencao',	
        'id_fornecedor',	
        'created_at',	
        'updated_at'
    ];
    public function item()
    {
        return $this->belongsTo(ItemPlanoManutencao::class,'id_item_plano_manutencao');
    }
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class,'id_fornecedor');
    }
}
