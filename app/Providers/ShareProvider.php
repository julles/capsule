<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;

class ShareProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
        
    public $menu;
    
    public function boot()
    {
        $this->menu = new Menu;
        
        if(\Auth::check())
        {
            view()->share('modelMenu',$this->menu);
            view()->share('menuAttribute',menuAttribute());
            view()->share('menuParent' ,  menuAttributeFind(menuAttribute()->parent_id));
            
        }    
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
