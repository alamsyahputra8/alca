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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller']	= 'viewfront';


// ROUTE PANEL PARWATHA
$route['panel'] 				= 'viewpanel';
$route['panel/ceklogin'] 		= 'viewpanel/ceklogin';
$route['panel/userprofile'] 	= 'viewpanel/userprofile';
$route['panel/roles'] 			= 'viewpanel/roles';
$route['panel/user'] 			= 'viewpanel/user';

$route['panel/menus'] 			= 'viewpanel/menus';
$route['panel/content'] 		= 'viewpanel/content';
$route['panel/blog'] 			= 'viewpanel/blog';
$route['panel/photos'] 			= 'viewpanel/photos';
$route['panel/videos'] 			= 'viewpanel/videos';
$route['panel/document'] 		= 'viewpanel/document';
$route['panel/link'] 			= 'viewpanel/link';
$route['panel/services'] 		= 'viewpanel/services';
$route['panel/works']	 		= 'viewpanel/works';
$route['panel/album']	 		= 'viewpanel/album';
$route['panel/event']	 		= 'viewpanel/event';
$route['panel/product']			= 'viewpanel/product';
$route['panel/product_category']= 'viewpanel/product_category';
$route['panel/product_type']	= 'viewpanel/product_type';
$route['panel/product-image/(:any)'] = 'viewpanel/product_image/$1';
$route['panel/live']			= 'viewpanel/stream';

$route['panel/detailinbox/(:any)'] = 'viewpanel/detailinbox/$1';
$route['panel/bannerads'] 		= 'viewpanel/bannerads';
$route['panel/banner'] 			= 'viewpanel/banner';
$route['panel/mailsite'] 		= 'viewpanel/mailsite';
$route['panel/config'] 			= 'viewpanel/config';
$route['panel/log'] 			= 'viewpanel/log';

$route['panel/logout'] 			= 'viewpanel/logout';

// ROUTE FRONT END
$route['home'] 					= 'viewfront/home';
$route['page/(:any)'] 			= 'viewfront/page/$1';
$route['blog/(:any)'] 			= 'viewfront/blog/$1';
$route['shop/(:any)/(:any)'] 	= 'viewfront/shop/$1/$2';
$route['works/(:any)'] 			= 'viewfront/works/$1';
$route['doc/(:any)'] 			= 'viewfront/doc/$1';
$route['event/(:any)'] 			= 'viewfront/event/$1';
$route['product/(:any)'] 		= 'viewfront/product/$1';
$route['quickview/(:any)'] 		= 'viewfront/quickview/$1';
$route['cart']	 				= 'cart';

// MIDTRANS
$route['checkout']	 			= 'viewfront/checkout';
$route['handle_notification']	= 'viewfront/handle_notification';
$route['payment/(:any)']	 	= 'viewfront/payment/$1';

$route['panel/listemail'] 		= 'viewpanel/listemail';

$route['panel/latest_transaction'] 			= 'viewpanel/latest_transaction';
$route['panel/reservation'] 				= 'viewpanel/reservation';
$route['panel/payment/detail/(:any)'] 		= 'viewpanel/paymentdetail/$1';
$route['panel/reservation/detail/(:any)'] 	= 'viewpanel/reservationdetail/$1';

$route['404_override'] 			= 'viewpanel/error';
$route['translate_uri_dashes'] 	= FALSE;
