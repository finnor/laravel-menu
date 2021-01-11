<?php

return [
/**
 * Template for building a menu
 *   'menus' => [
 *       [
 *           'name' => 'Dashboard', // the menu label displayed
 *           'action' => 'DashboardController@index', // the action this menu button calls
 *           'icon' => 'fas fa-dashboard', // font awesome icon
 *           'groups' => [1,2,3,4], // These are user group ids
 *           'options' => null, // which options fall under this menu
 *           'domains' => [
 *               'DashboardController' // the domain tells the view composer that this menu should be highlighted for actions in this controller
 *           ]
 *       ],
 *       [
 *           'name' => 'Settings',
 *           'action' => null,
 *           'icon' => 'fas fa-wrench',
 *           'groups' => [1,2],
 *           'options' => [
 *               [
 *                   'name' => 'User Groups',
 *                   'action' => 'UserGroupsController@index',
 *                   'icon' => null,
 *                   'groups' => [1,2],
 *                   'domains' => [
 *                       'UserGroupsController@index',
 *                       'UserGroupsController@create',
 *                       'UserGroupsController@show',
 *                       'UserGroupsController@edit',
 *                   ]
 *               ],
 *               [
 *                   'name' => 'User Accounts',
 *                   'action' => 'UsersController@index',
 *                   'icon' => null,
 *                   'groups' => [1,2],
 *                   'domains' => [
 *                       'UsersContoller@index',
 *                       'UsersContoller@create',
 *                       'UsersContoller@show',
 *                       'UsersContoller@edit',
 *                   ]
 *               ]
 *           ]
 *       ]
 *   ],
 *   ...
 */
];