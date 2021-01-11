<?php

namespace AFlanry\Menu;

class MenuBuilder
{
    /**
     * Builds the menu into a tree of top menu and submenus
     *
     * @param Collection $menus
     * @param boolean    $isTopOnly
     *
     * @return Collection
     */
    private static function buildMenu($menus, $isTopOnly = false) {
        $topLevel = $menus->filter(function($menu) {
            return is_null($menu->menu_parent_id);
        });
        return $topLevel->map(function($topMenu) use ($menus) {
            $topMenu->options = ($isTopOnly) ?
                collect([]) :
                $menus->filter(function($menu) use ($topMenu) {
                    return $menu->menu_parent_id===$topMenu->id;
                });

            return $topMenu;
        });
    }

    /**
     * Flags the menus that should be displayed as active
     * by either the activeMenu id or the actionName
     *
     * @param Collection $menus
     * @param integer    $activeMenu
     * @param string     $actionName
     *
     * @return Collection
     */
    private static function setActive($menus, $activeMenu, $actionName) {
        // if active menu id is present then set that menu active
        if(! is_null($activeMenu)) {
            $menus->each(function($topMenu, $index) use ($activeMenu, $menus) {
                if($topMenu->id===$activeMenu) {
                    $menus[$index]->active = true;
                }
                $topMenu->options->each(function($menu, $jindex) use($index, $activeMenu, $menus) {
                    if($menu->id===$activeMenu) {
                        $menus[$index]->active = true;
                        $menus[$index]->options[$jindex]->active = true;
                    }
                });
            });
        // else set the active menu by action name
        } else {
            $menus->each(function($topMenu, $index) use ($actionName, $menus) {
                if($topMenu->action===$actionName) {
                    $menus[$index]->active = true;
                }
                $topMenu->options->each(function($menu, $jindex) use ($index, $actionName, $menus) {
                    if($menu->action===$actionName) {
                        $menus[$index]->active = true;
                        $menus[$index]->options[$jindex]->active = true;
                    }
                });
            });
        }

        return $menus;
    }
}
