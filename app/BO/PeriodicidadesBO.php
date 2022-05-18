<?php

namespace App\BO;

use App\Model\Periodicidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeriodicidadesBO
{

    private $prosseguir;
    private $data;
    private $periodicidade;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->periodicidade = (new Periodicidade())->all();  
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
        return $objeto;
    }

    public function update($request, $id)
    {
        $objeto = new \stdClass();  
        return $objeto;       
    }


    public function destroy($id)
    {
        $objeto = new \stdClass();
        return $objeto;
    }

    public function create() {}
    public function edit(Periodicidade $periodicidade)
    {
        return $periodicidade;
    }
    public function show(Periodicidade $periodicidade)
    {
        return $periodicidade;
    }

    

}