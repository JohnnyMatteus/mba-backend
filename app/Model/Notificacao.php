<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    use Uuid;
    protected $table = 'notificacoes';
    protected $guarded = ['id'];

    protected $fillable = [
        'id',	'uuid',	'status',	'data_notificacao',	'id_empreendimento',	'id_usuario',	'id_periodicidade',	'id_componente',	'created_at',	'updated_at'
    ];
    public function empreendimento()
    {
        return $this->belongsTo(Empreendimento::class,'id_empreendimento');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class,'id_usuario');
    }
    public function periodicidade()
    {
        return $this->belongsTo(Periodicidade::class,'id_periodicidade');
    }
    public function componente()
    {
        return $this->belongsTo(Componentes::class,'id_componente');
    }
}
