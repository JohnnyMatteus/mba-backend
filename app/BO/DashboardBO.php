<?php

namespace App\BO;

use App\Model\User;
use Illuminate\Http\Request;
use App\Model\Empreendimento;
use App\Model\Empresa;
use App\Model\PlanoManutencao;
use Illuminate\Support\Facades\Storage;

class DashboardBO
{
    private $prosseguir;
    private $data;
    private $dashboard;

    public function painelAdministrativo()
    {
        $objeto = new \stdClass();
        $objeto->totalizadores = $this->totalizadores();
        $objeto->estatiscas = (new AtividadeBO)->estatiscasGeraisMesAtual();
        $objeto->estatiscasPlanos  = (new PlanoManutencaoBO)->estatiscasGerais();       
        $objeto->atividadesSemanal = (new PlanoManutencaoBO)->atividadesSemanal();
        
        return $objeto;
    }
    public function painelEmpresa()
    {
        # code...
    }
    public function painelSindico()
    {
        # code...
    }

    private function totalizadores()
    {
        $objeto = new \stdClass();
        $objeto->usuarios = (new User())->count();
        $objeto->empresas = (new Empresa())->count();
        $objeto->empreendimentos = (new Empreendimento())->count();
        $objeto->planos = (new PlanoManutencao())->count();
        return $objeto;
    }

    

}