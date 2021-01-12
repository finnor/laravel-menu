<?php

namespace Aflanry\Menu;

use Aflanry\Menu\MenuBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

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
                $menus->join('access_menus', function($join) use ($user) {
                    $join->on('menus.id', '=', 'access_menus.menu_id')
                        ->where('access_menus.group_id', $user->group_id);
                });
            }
            $menus = $menus->get();

            // Build the menu
            $menus = MenuBuilder::buildMenu($menus, true);
        }
        $view->with('menus', $menus);
    }
}
