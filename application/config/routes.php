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
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['Contact'] = 'main/contact';

//Account - PAGE SESSION  = OFF
$route['sign-in'] = 'main/signin_page';
$route['sign-up'] = 'main/signup_page';
$route['auth/sign-in'] = 'App/AppControllers/AuthSignin';
$route['auth/sign-up'] = 'App/AppControllers/AuthSignup';
$route['auth/sign-out'] = 'App/AppControllers/AuthSignout';

//Account - PAGE SESSION  = ON
$route['Profile/myorder'] = 'main/profile_order';
$route['Profile/account'] = 'main/my_profile';
$route['Profile/changepassword'] = 'App/AppControllers/AuthChangPassword';


$route['topup/(:num)'] = 'main/page_topup/$1';
$route['topup/process'] = 'App/AppControllers/process_topup';

//PRODUCT - PAGE
$route['product'] = 'main/product_page';
$route['product/cart'] = 'main/product_cart';
$route['product/category/(:num)'] = 'main/product_category_page/$1';
$route['product/detail/(:num)'] = 'main/product_detail_page/$1';
$route['product/order/detail/(:num)'] = 'main/product_order_detail/$1';
$route['product/cart_process'] = 'App/AppControllers/product_cart_process';
$route['product/cart_process_two'] = 'App/AppControllers/cart_process_two';
$route['product/get_total_price'] = 'App/AppControllers/get_total_price';


//Online
$route['Online'] = 'main/online_index';
$route['Online/mygift'] = 'main/online_mygift';
$route['Online/gift/(:num)'] = 'main/online_gift/$1';
$route['Online/InsertGift'] = 'App/AppControllers/InsertGift';

//Backend
$route['Backend/manager/product'] = 'main/backend_product';
$route['Backend/manager/product/edit/(:num)'] = 'main/backend_product_edit/$1';
$route['Backend/manager/product/add'] = 'main/backend_product_add';
$route['Backend/save/product_edit'] = 'App/AppControllers/product_edit';
$route['Backend/save/product_add'] = 'App/AppControllers/product_add';
$route['Backend/delete/product'] = 'App/AppControllers/product_delete';

$route['Backend/manager/category'] = 'main/backend_category';
$route['Backend/save/category_edit'] = 'App/AppControllers/category_edit';
$route['Backend/save/category_add'] = 'App/AppControllers/category_add';
$route['Backend/delete/category'] = 'App/AppControllers/category_delete';

$route['Backend/manager/online'] = 'main/backend_online';
$route['Backend/delete/online'] = 'App/AppControllers/online_delete';

$route['Backend/manager/billing'] = 'main/backend_billing';

$route['Backend/manager/orders'] = 'main/backend_orders';
$route['Backend/manager/orders_detail/(:num)'] = 'main/backend_orders_detail/$1';
$route['Backend/save/orders_add'] = 'App/AppControllers/orders_add';
$route['Backend/delete/orders_delete'] = 'App/AppControllers/orders_delete';


$route['Backend/manager/order_update'] = 'App/AppControllers/order_update';

