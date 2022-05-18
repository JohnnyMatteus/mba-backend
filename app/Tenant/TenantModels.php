<?php

namespace App\Tenant;


use App\Model\Empresa;
use Illuminate\Database\Eloquent\Model;

trait TenantModels
{

    protected static function bootTenantModels()
    {
        $empresa = \Tenant::getTenant();

        static::addGlobalScope(new TenantScope());

        static::creating(function (Model $obj) use ($empresa) {
            if($empresa) 
            {
                $obj->id_empresa = $empresa->id;
            }
        });
    }

    public function empresa(){
        return $this->belongsTo(\Tenant::getTenantModel(), \Tenant::getTenantKey());
    }
}