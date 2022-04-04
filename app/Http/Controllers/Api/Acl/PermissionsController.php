<?php

namespace App\Http\Controllers\Api\Acl;

use App\Model\Permission;
use App\BO\Acl\PermissionsBO;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
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
        /*if (Gate::denies('permission.index'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $permissionBO = new PermissionsBO();
        $this->return = $permissionBO->initialize();

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*if (Gate::denies('permission.create'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
        $permissionBO = new PermissionsBO();
        $this->return = $permissionBO->store($request);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $role)
    {
        /*if (Gate::denies('permission.update'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
    
        $permissionBO = new PermissionsBO();
        $this->return = $permissionBO->update($request, $role);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Role  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission  $permission)
    {
        /*if (Gate::denies('permission.delete'))
        {
            return redirect()->back()->with("error", "Você não tem permissão de acesso.");
        }*/
    
        $permissionBO = new PermissionsBO();
        $this->return = $permissionBO->destroy($permission);

        if (!$this->return) {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
