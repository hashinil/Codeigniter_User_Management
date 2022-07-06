<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'user/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*$route['user/welcome'] = 'user/welcome';
$route['user/delete_user'] = 'user/delete_user';
$route['user/delete_user_group'] = 'user/delete_user_group';
$route['user/logout'] = 'user/logout';
$route['user/delete_user'] = 'user/delete_user';
$route['user/user_list'] = 'user/user_list';
$route['user/usergroup_list'] = 'user/usergroup_list';
$route['user/create'] = 'user/create';
$route['user/create_user_group'] = 'user/create_user_group';
$route['user/login'] = 'user/login';
$route['user/(:any)'] = 'user/view/$1';
$route['user/edit_user'] = 'user/edit_user';
$route['user'] = 'user';
$route['(:any)'] = 'user/login';
$route['default_controller'] = 'user';*/

$route['default_controller'] = 'user';
$route['(:any)/login/(:any)']  = 'user/login';
$route['(:any)/welcome/(:any)']  = 'user/welcome';
$route['(:any)/user_list/(:any)']  = 'user/user_list';
$route['(:any)/create/(:any)']  = 'user/create';

$route['(:any)/(:any)/edit_user/(:num)']  = 'user/edit_user';

