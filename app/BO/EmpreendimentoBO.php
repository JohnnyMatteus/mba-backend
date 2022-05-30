<?php

namespace App\BO;

use App\Model\Empresa;
use Illuminate\Http\Request;
use App\Model\Empreendimento;
use Illuminate\Support\Facades\Auth;
use App\Exports\EmpreendimentosExport;

class EmpreendimentoBO
{

    private $prosseguir;
    private $data;
    private $empreendimento;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->empreendimento = (new Empreendimento())->all();   

        return $objeto;
    }
    public function initialize()
    {
        $objeto = new \stdClass();
        $objeto->empreendimentos = (new Empreendimento())->all(); 
        $objeto->empreendimentos->map(function($item) {
            $item->logo = asset("empreendimentos/{$item->logo}");
        });
        $objeto->empresas = (Auth::user()->roles[0]['name'] == "Administrador") ? (new Empresa())->all() : ["id" => Auth::user()->id_empresa];
      

        return $objeto;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objeto = new \stdClass();
        if ($request->hasFile('logo'))
        {
            $nameFile = preg_replace('/\s+/', '', $request->name.'.'.$request->logo->extension());
            $request->logo->storeAs('empreendimentos/logos', $nameFile);
            $request->merge([
                "logo_name" => $nameFile
            ]);
        }       
        $objeto->empreendimento = (new Empreendimento())->firstOrCreate([
            'name'                 => $request->name,
            'fone'                 => $request->fone,
            'status'               => "A", 
            'logo'                 => (isset($request->logo_name)) ? $request->logo_name : $request->logo, 
            'endereco'             => $request->endereco, 
            'description'          => $request->description, 
            'id_empresa'           => $request->id_empresa,             
            'slug'                 => $request->slug
        ]);
    
        return $objeto->empreendimento;
    }

    public function update($request, $empreendimento)
    {
        $objeto = new \stdClass();
        if ($request->hasFile('logo'))
        {
            $nameFile = preg_replace('/\s+/', '', $request->name.'.'.$request->logo->extension());
            $request->logo->storeAs('empreendimentos/logos', $nameFile);
            $request->merge([
                "logo_name" => $nameFile
            ]);
        }
        $objeto->empreendimento = (new Empreendimento())->find($empreendimento);
        $objeto->empreendimento->update([
            'name'                 => $request->name,
            'fone'                 => $request->fone,
            'status'               => $request->status, 
            'logo'                 => (isset($request->logo_name)) ? $request->logo_name : $request->logo, 
            'endereco'             => $request->endereco, 
            'description'          => $request->description, 
            'id_empresa'           => $request->id_empresa,             
            'slug'                 => $request->slug
        ]);    
        return $objeto->empreendimento;       
    }


    public function destroy($empreendimento)
    {
        $objeto = new \stdClass();
        $objeto->empreendimento = (new Empreendimento())->find($empreendimento);
        return $objeto->empreendimento->delete();
    }

    public function create() {}
    public function edit(Empreendimento $empreendimento) {}
    public function show(Empreendimento $empreendimento) {}
    public function exportCSV() 
    {
        return \Excel::download(new EmpreendimentosExport, 'lista_empreendimentos.xlsx');
    }
    public function exportPDF() 
    {
        return \Excel::download(new EmpreendimentosExport, 'lista_empreendimentos.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }    

}