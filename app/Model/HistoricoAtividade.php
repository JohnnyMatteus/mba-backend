<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HistoricoAtividade extends Model
{
    use Uuid;
    protected $table = 'atividades';
    protected $guarded = ['id'];

    protected $fillable = [
        'id',	'uuid',	'de',	'para',	'id_atividade',	'id_usuario',	'created_at',	'updated_at'
    ];
    public function atividade()
    {
        return $this->belongsTo(Atividade::class,'id_atividade');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class,'id_usuario');
    }
}
