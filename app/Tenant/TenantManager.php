<?php
namespace App\Tenant;

use Illuminate\Database\Schema\Blueprint;
use App\Model\Empresa;

class TenantManager
{
    private $tenant;
    private static $tenantTabela = 'empresas';
    private static $tenantKey = 'id_empresa';
    private static $tenantModel = Empresa::class;


    /**
     * @return string
     */
    public function getTenantTabela() : string
    {
        return self::$tenantTabela;
    }

    /**
     * @return string
     */
    public function getTenantKey() : string
    {
        return self::$tenantKey;
    }

    /**
     * @return string
     */
    public function getTenantModel() : string
    {
        return self::$tenantModel;
    }

    /**
     * @return Empresa
     */
    public function getTenant(): ?Empresa //null or Empresa
    {
        return $this->tenant;
    }

    /**
     * @param Empresa $tenant
     */
    public function setTenant(?Empresa $tenant): void
    {
        $this->tenant = $tenant;
    }

    public function bluePrintMacros()
    {
        Blueprint::macro('tenant', function($after = null){
            !\is_null($after) ? $this->integer(\Tenant::getTenantKey())->unsigned()->after($after) : $this->integer(\Tenant::getTenantKey())->unsigned();
        });
    }
}