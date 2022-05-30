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
    
    public static function estatiscasGeraisMesAtual()
    {
        $where = (\Auth::user()->roles[0]['name'] != "Administrador") ? "AND pm.id_empresa = ".\Auth::user()->id_empresa : "";
  
        $query = "SELECT COUNT(*) AS 'total',
        CASE
            WHEN a.status = 'A' THEN 'A fazer'
            WHEN a.status = 'P' THEN 'Pendentes'
            WHEN a.status = 'D' THEN 'Concluidas'
            WHEN a.status = 'I' THEN 'Invalidas'
            ELSE 'Invalidas'
        END as 'title'
        FROM atividades a
        LEFT JOIN itens_plano_manutencao ipm ON ipm.id = a.id_item_plano_manutencao
        LEFT JOIN planos_manutencao pm ON pm.id = ipm.id_plano
        WHERE MONTH(a.data_atividade) = MONTH(CURRENT_DATE())
        $where
        GROUP BY a.status";
        
        return \DB::select($query);
    }

    public static function estatiscasGerais()
    {
        $where = (\Auth::user()->roles[0]['name'] != "Administrador") ? "AND pm.id_empresa = ".\Auth::user()->id_empresa : "";
  
        $query = "SELECT COUNT(*) AS 'total',
        CASE
            WHEN a.status = 'A' THEN 'A fazer'
            WHEN a.status = 'P' THEN 'Pendentes'
            WHEN a.status = 'D' THEN 'Concluidas'
            WHEN a.status = 'I' THEN 'Invalidas'
            ELSE 'Invalidas'
        END as 'title'
        FROM atividades a
        LEFT JOIN itens_plano_manutencao ipm ON ipm.id = a.id_item_plano_manutencao
        LEFT JOIN planos_manutencao pm ON pm.id = ipm.id_plano
        $where
        GROUP BY a.status";
        
        return \DB::select($query);
    }

}
