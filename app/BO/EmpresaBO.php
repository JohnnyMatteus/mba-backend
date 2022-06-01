<?php

namespace App\BO;

use App\Model\Empresa;
use Illuminate\Http\Request;
use App\Exports\EmpresasExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmpresaBO
{

    private $prosseguir;
    private $data;
    private $empresa;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->empresas = (new Empresa())->all();   

        return $objeto;
    }
    public function initialize()
    {
        $objeto = new \stdClass();
        $objeto->empresas = $objeto->empresas = (Auth::user()->roles[0]['name'] == "Administrador") ? (new Empresa())->all() : ["id" => Auth::user()->id_empresa];; 
        
        if (count($objeto->empresas) > 2)
        {
            $objeto->empresas->map(function($item)
            {
                (isset($item->logo)) ?? $item->logo = asset("empresas/{$item->logo}");
            });
        }


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
            $request->logo->storeAs('empresas/logos', $nameFile);
            $request->merge([
                "logo_name" => $nameFile
            ]);
        }       
        $objeto->empresa = (new Empresa())->firstOrCreate([
            'name'                 => $request->name,
            'fone'                 => $request->fone,
            'cell'                 => $request->cell, 
            'status'               => "A", 
            'logo'                 => (isset($request->logo_name)) ? $request->logo_name : $request->logo, 
            'access_name'          => $request->slug, 
            'description'          => $request->description, 
            'email'                => $request->email, 
            'name_responsible'     => $request->name_responsible,        
            'site'                 => $request->site, 
            'slug'                 => $request->slug,
        ]);
        return $objeto->empresa;
    }

    public function update($request, $empresa)
    {
        $objeto = new \stdClass();
        $objeto->empresa = (new Empresa())->find($empresa);
        $objeto->empresa->update([
            'name'                 => $request->name,
            'fone'                 => $request->fone,
            'cell'                 => $request->cell, 
            'status'               => $request->status, 
            'logo'                 => $request->logo, 
            'access_name'          => $request->access_name, 
            'description'          => $request->description, 
            'email'                => $request->email, 
            'name_responsible'     => $request->name_responsible,        
            'site'                 => $request->site, 
            'slug'                 => $request->slug
        ]);    
        return $objeto->empresa;       
    }


    public function destroy($empresa)
    {
        $objeto = new \stdClass();
        $objeto->empresa = (new Empresa())->find($empresa);
        return $objeto->empresa->delete();
    }

    public function create() {}
    public function edit(Empresa $empresa) {}
    public function show(Empresa $empresa) {}
    public function findById($id)
    {
        $objeto = new \stdClass();
        $objeto->empresa = (new Empresa)->find($id);
        return $objeto->empresa;
    }

    public function exportCSV() 
    {
        return \Excel::download(new EmpresasExport, 'lista_empresas.xlsx');
    }
    public function exportPDF() 
    {
        return \Excel::download(new EmpresasExport, 'lista_empresas.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    

}