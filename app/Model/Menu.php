<?php

namespace App\Model;

use App\Model\Uuid;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use Uuid;
    protected $table = 'menus';
    protected $guarded = ['id'];

    protected $fillable = [
        'id', 
        'uuid',
        'id_permission',
        'menu_id',
        'title',
        'icon',
        'to',
        'ordem',
        'created_at',	
        'updated_at'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'id_permission');
    }
    public function children()
    {
        return $this->hasMany(Menu::class);
    }
    public static function listaMenus()
    {
        $query = "SELECT m.id,
                         m.title,
                         m.ordem,
                         m.id_permission,
                         m.to,
                         m.menu_id,
                         m.icon,
                         m2.menu_id AS hasChild,
                         p.name AS permission,
                         GROUP_CONCAT(DISTINCT m2.id ORDER BY m2.ordem ) AS listaFilhos
                    FROM menus m
               LEFT JOIN menus m2
                      ON m.id = m2.menu_id
               LEFT JOIN permissions p
                      ON m.id_permission = p.id    
               GROUP by m.id
               ORDER BY m.menu_id DESC, listaFilhos";
        return \DB::select($query);
    }
}
