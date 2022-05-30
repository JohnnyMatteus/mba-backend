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
    public static function estatiscasGerais()
    {
        $where = (\Auth::user()->roles[0]['name'] != "Administrador") ? "AND pm.id_empresa = ".\Auth::user()->id_empresa : "";
  
        $query = "SELECT 
                COUNT(*) AS 'total', 
                pm.status as 'name',
                CASE WHEN pm.status = 'A' THEN 'Ativo' 
                    WHEN pm.status = 'P' THEN 'Pendente' 
                    WHEN pm.status = 'C' THEN 'Concluido' 
                    WHEN pm.status = 'I' THEN 'Invalido' 
                    ELSE 'Invalido'  
                END as 'title'
            FROM planos_manutencao pm 
            $where
            GROUP BY pm.status ";
        
        return \DB::select($query);
    }

    public static function atividadesSemanal()
    {
        $where = (\Auth::user()->roles[0]['name'] != "Administrador") ? "AND pm.id_empresa = ".\Auth::user()->id_empresa : "";
  
        $query = "SELECT a.status,  
        WEEKDAY(a.data_atividade) as 'dia'  
        FROM atividades a  
        WHERE WEEKDAY(a.data_atividade)>0 AND WEEKDAY(a.data_atividade)<6 $where";
        
        return \DB::select($query);
    }
    
}
