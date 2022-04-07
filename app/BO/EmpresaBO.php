<?php

namespace App\BO;

use App\Model\Empresa;
use Illuminate\Http\Request;

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
        $objeto->empresas = (new Empresa())->all(); 

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
        $objeto->empresa = (new Empresa())->firstOrCreate([
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

    

}