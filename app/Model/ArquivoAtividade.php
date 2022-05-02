<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArquivoAtividade extends Model
{
    use Uuid;
    protected $table = 'arquivos_atividades';
    protected $guarded = ['id'];

    protected $fillable = [
        'id',	'uuid',	'arquivo',	'tipo',	'id_atividade',	'id_usuario',	'created_at',	'updated_at'
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
