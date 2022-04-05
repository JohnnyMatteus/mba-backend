<?php

namespace App\BO;

use App\Model\Menu;
use App\Model\Permission;
use Illuminate\Http\Request;

class MenuBO
{

    private $prosseguir;
    private $data;
    private $menu;
    private $assignedMenu    = [];
    private $listaMenuRetorno = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objeto = new \stdClass();
        $objeto->menus = (new Menu())->listaMenus(); 
        $objeto->permissions = (new Permission())->all()->pluck('name', 'id');

        $this->menu = $this->normalizarMenu($objeto->menus);
        unset($objeto->menus);        
        $objeto->menus = $this->menu;   

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
        $objeto->menu = (new Menu())->firstOrCreate([
            "id_permission"     => $request->id_permission,
            "menu_id"           => $request->menu_id,
            "title"             => $request->title,
            "icon"              => $request->icon,
            "to"                => $request->to	
        ]);
        return $objeto->menu;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Model\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update($request, Menu $menu)
    {
        $objeto = new \stdClass();
        $objeto->menu = $menu->update([
            "id_permission"     => $request->id_permission,
            "menu_id"           => $request->menu_id,
            "title"             => $request->title,
            "icon"              => $request->icon,
            "to"                => $request->to	
        ]);       
        return $menu;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        return $menu->delete();
    }

    private function normalizarMenu($listaMenu)
    {
        foreach ($listaMenu as $menu)
        {
            $arrayDataMenu = $this->getArrayMenuFormatado($menu);
           
            if ($menu->hasChild && !\array_key_exists($menu->id, $this->assignedMenu) && \is_null($menu->menu_id))
            {
                
                $this->assignedMenu[$menu->id]                 = true;                
                $this->listaMenuRetorno[$menu->id]             = $arrayDataMenu;               
                $this->listaMenuRetorno[$menu->id]["children"] = $this->construirArvoreMenu($listaMenu, $menu->id);                
                $this->listaMenuRetorno[$menu->id]["children"] = $this->ordenaMenu($this->listaMenuRetorno[$menu->id]["children"], "ordem");
            }            
        }
        
        $this->listaMenuRetorno = $this->ordenaMenu($this->listaMenuRetorno, "ordem");
        $this->assignedMenu = [];
        return array_values($this->listaMenuRetorno);
    }
    private function getArrayMenuFormatado($menu) : array
    {
        if ($menu)
        {
            $permission = explode(".", $menu->permission);
            return [
                "id" => $menu->id,
                "key" => $menu->id,
                "label" => $menu->title,
                "title" => $menu->title,
                "icon" => $menu->icon ?? "",
                "to"  => $menu->to ??  "",
                "ordem" => $menu->ordem,                
                "id_permission" => $menu->id_permission,
                "resource" => ucfirst($permission[0]),
                "action"  =>$permission[1]       
            ];
        }
        return [];
    }
    private function construirArvoreMenu($listaMenu, int $idPai): array
    {
    
        $listaMenuReturn = [];
        foreach ($listaMenu as $menu)
        {
            $arrayDataMenu = $this->getArrayMenuFormatado($menu);
            if ($idPai > 0 && $idPai == $menu->menu_id && $menu->hasChild > 0)
            {
                $listaMenuReturn[$menu->id]             = $arrayDataMenu;
                $listaMenuReturn[$menu->id]["children"] = $this->construirArvoreMenu($listaMenu, $menu->id);
                $this->assignedMenu[$menu->id]          = true;

                $listaMenuReturn[$menu->id]["children"] = $this->ordenaMenu($listaMenuReturn[$menu->id]["children"], "ordem");
            }
            else if ($idPai > 0 && $menu->menu_id == $idPai && !$menu->hasChild)
            {
                $listaMenuReturn[$menu->id]         = $arrayDataMenu;
                $this->assignedMenu[$menu->menu_id] = true;
            }
            
        }
        return array_values($listaMenuReturn);
    }
    private function ordenaMenu($arrayMenu, $coluna)
    {
        $arrayOrdem = \array_column($arrayMenu, "{$coluna}");
        if (\count($arrayOrdem) && \count($arrayOrdem) == \count($arrayMenu))
        {
            \array_multisort($arrayOrdem, SORT_ASC, $arrayMenu);
        }
        return $arrayMenu;
    }

}