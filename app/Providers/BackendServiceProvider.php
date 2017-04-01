<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //\DB::listen(function($query) { \Log::info($query); });
        view()->composer('*', function ($view) {
            //共享菜单数据
            $menus = Menu::where('pid', '0')->orderBy('sort')->get();
            $view->with('menus',$menus);
        });
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
