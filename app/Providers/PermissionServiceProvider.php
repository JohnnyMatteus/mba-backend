<?php

namespace App\Providers;

use App\Model\Permissions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $permissoes = Permissions::all();
        foreach ($permissoes as $permissao)
        {
            Gate::define($permissao->name, function($user) use ($permissao){
                return $user->hasPermissionTo($permissao->name);
            });
        }
    }
}
