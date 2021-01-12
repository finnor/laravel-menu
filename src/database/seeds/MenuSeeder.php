<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menu_domains')->truncate();
        DB::table('access_menus')->truncate();
        DB::table('menus')->truncate();
        $now = Carbon::now();
        $menus = config('menu.menus');

        for($i=0; $i<count($menus); $i++) {
            $menu = $menus[$i];
            $menuId = DB::table('menus')->insertGetId([
                'name' => $menu['name'],
                'action' => $menu['action'],
                'icon' => $menu['icon'],
                'order' => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            if(isset($menu['options'])) {
                for($j=0; $j<count($menu['options']); $j++) {
                    $submenu = $menu['options'][$j];
                    $submenuId = DB::table('menus')->insertGetId([
                        'name' => $submenu['name'],
                        'action' => $submenu['action'],
                        'icon' => $submenu['icon'],
                        'order' => $j,
                        'menu_parent_id' => $menuId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    if(isset($submenu['groups'])) {
                        $this->insertGroups($submenu['groups'], $submenuId);
                    }
                    if(isset($submenu['domains'])) {
                        $this->insertMenuDomains($submenu['domains'], $submenuId, $now);
                    }
                }
            }

            if(isset($menu['groups'])) {
                $this->insertGroups($menu['groups'], $menuId);
            }
            if(isset($menu['domains'])) {
                $this->insertMenuDomains($menu['domains'], $menuId, $now);
            }
        }
    }

    /**
     * Associates the menu with an array of user groups
     * @param integer[] $groups
     * @param integer   $menuId
     */
    private function insertGroups($groups, $menuId) {
        $inserts = [];
        foreach($groups as $group) {
            $inserts[] = [
                'group_id' => $group,
                'menu_id' => $menuId
            ];
        }
        DB::table('access_menus')->insert($inserts);
    }

    /**
     * Associates the menu with an array of menu domains
     * @param integer[] $domains
     * @param integer   $menuId
     * @param Carbon    $now
     */
    private function insertMenuDomains($domains, $menuId, $now) {
        $inserts = [];
        for($j=0; $j<count($domains); $j++) {
            $domain = $domains[$j];
            $inserts[] = [
                'type' => (strpos($domain, '@')!==false) ? 'action' : 'controller',
                'value' => $domain,
                'menu_id' => $menuId,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('menu_domains')->insert($inserts);
    }
}
