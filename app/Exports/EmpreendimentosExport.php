<?php

namespace App\Exports;

use App\Model\Empreendimento;
use Maatwebsite\Excel\Concerns\FromCollection;
use stdClass;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmpreendimentosExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Empreendimento::all();
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
