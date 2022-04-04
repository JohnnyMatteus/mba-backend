<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use Uuid;
    protected $table = 'social_accounts';
    protected $guarded = ['id'];

    protected $fillable = [
        'id', 
        'uuid',
        'id_usuario',
        'provider_user_id',
        'provider',
        'created_at',	
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
