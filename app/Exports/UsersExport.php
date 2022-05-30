<?php

namespace App\Exports;

use App\Model\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use stdClass;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $objeto = new stdClass();
        $objeto->usuarios = (new User)->exportCSV();
        $objeto->usuarios->map(function($usuario) {
            $usuario->role = (isset($usuario->roles) && count($usuario->roles) > 0) ? $usuario->roles[0]->name : false;            
            $usuario->status = ($usuario->status == 'A') ? 'Ativo' : 'Inativo';
            $usuario->empresa = (isset($usuario->empresa)) ? $usuario->empresa->name : "Sem empresa";            
            $usuario->cadastro = date('d/m/Y', strtotime($usuario->created_at));            
            $usuario->atualizacao = date('d/m/Y', strtotime($usuario->updated_at));   

            unset($usuario->roles);
            unset($usuario->id_empresa);
            unset($usuario->updated_at);
            unset($usuario->created_at);
        });
        return $objeto->usuarios;
    }
    public function headings(): array
    {
        return [
            'Nome',
            'E-mail',
            'Status',
            'Papel',
            'Empresa',
            'Data cadastro',
            'Última atualização',
        ];
    }
}
