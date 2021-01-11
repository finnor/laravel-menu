<?php

namespace AFlanry\Menu;

use AFlanry\Menu\MenuBuilder;
use Auth;
use DB;
use Illuminate\View\View;
use Illuminate\Routing\Route;

class NavMenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $isLoggedIn = Auth::check();
        $menus = collect([]);
        if ($isLoggedIn) {
            $user = Auth::user();
            $menus = DB::table('menus')
                ->select('menus.id', 'menus.name', 'menus.action', 'menus.icon', 'menus.menu_parent_id', 'menus.order')
                ->orderBy('menus.menu_parent_id', 'asc')
                ->orderBy('menus.order', 'asc');
            if(! $user->isAdmin()) {
                $menus->innerJoin('access_menus', function($join) use ($user) {
                    $join->on('menus.id', '=', 'access_menus.menu_id')
                        ->where('access_menus.group_id', $user->group_id);
                });
            }
            $menus = $menus->get();

            //Get current action
            $route = Route::currentRouteAction();
            if (! is_null($route)) {
                $actionArr = explode('\\', $route);
                $actionName = end($actionArr);
            } else {
                $actionName = 'UsersController@dashboard';
            }
            // Get the menu that should be active
            $domains = DB::table('menu_domains')
                ->select('type', 'value')
                ->where(function($query) use ($actionName) {
                    $query->where(function($query) use($actionName) {
                        $query->where('type', 'controller')
                            ->where('value', explode('@', $actionName, 2)[0]);
                    })->orWhere(function($query) use($actionName) {
                        $query->where('type', 'action')
                            ->where('value', $actionName);
                    });
                })
                ->whereNull('deleted_at')
                ->orderBy('type', 'DESC') // put action first
                ->get();
            if($domains->count()>0)
                $activeMenu = $domains[0]->menu_id;
            else
                $activeMenu = null;

            // Build the menu
            $menus = MenuBuilder::buildMenu($menus, true);

            // Add an active flag to the active menu
            $menus = MenuBuilder::setActive($menus, $activeMenu, $actionName);
        }
        $view->with('menus', $menus);
    }
}
