<?php

namespace App\Http\Controllers\Api\Acl;

use App\Model\Role;
use App\BO\Acl\RolesBO;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{

    private $return;
    private $code;
    private $message;

    public function __construct()
    {
        $this->return  = false;
        $this->code    = config('httpstatus.success.ok');
        $this->message = null;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if (Gate::denies('roles.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $rolesBO = new RolesBO();
        $this->return = $rolesBO->initialize();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*if (Gate::denies('roles.create'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $rolesBO = new RolesBO();
        $this->return = $rolesBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        /*if (Gate::denies('roles.update'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
    
        $rolesBO = new RolesBO();
        $this->return = $rolesBO->update($request, $role);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        /*if (Gate::denies('roles.delete'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
    
        $rolesBO = new RolesBO();
        $this->return = $rolesBO->destroy($role);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
