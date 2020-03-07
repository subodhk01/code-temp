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


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['admin'] = 'admin/index';
$route['admin/register'] = 'admin/register';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/login'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';
$route['admin/change_password'] = 'admin/change_password';
$route['admin/reset_password'] = 'admin/reset_password';
$route['admin/reports'] = 'reports';
$route['admin/users'] = 'reports/users';
$route['admin/requests'] = 'reports/requests';
$route['admin/requests/(:num)'] = 'reports/requests/$1';
$route['admin/reports/(:any)'] = 'reports/$1';
$route['admin/reports/edit_category/(:num)'] = 'reports/add_category/$1';
$route['admin/reports/edit_report/(:num)'] = 'reports/add_report/$1';

$route['admin/blogs'] = 'reports/blogs';
$route['admin/blogs/add_blog'] = 'reports/add_blog/$1';
$route['admin/blogs/edit_blog/(:num)'] = 'reports/add_blog/$1';

$route['admin/pages'] = 'reports/pages';
$route['admin/pages/add_page'] = 'reports/add_page/$1';
$route['admin/pages/edit_page/(:num)'] = 'reports/add_page/$1';

$route['admin/users/edit_user/(:num)'] = 'reports/add_user/$1';
$route['admin/users/add_user'] = 'reports/add_user/$1';

$route['admin/get_requests_ajax'] = 'reports/get_requests_ajax';
$route['admin/get_reports_ajax'] = 'reports/get_reports_ajax';
$route['admin/get_categories_ajax'] = 'reports/get_categories_ajax';
$route['admin/get_blogs_ajax'] = 'reports/get_blogs_ajax';
$route['admin/get_pages_ajax'] = 'reports/get_pages_ajax';
$route['admin/get_users_ajax'] = 'reports/get_users_ajax';

$route['/'] = 'home/index';
$route['contact-us'] = 'home/contact_us';

/*Request pages*/
$route['request-sample/(:any)'] = 'home/request_page/$1';
$route['speak-to-analyst/(:any)'] = 'home/request_page/$1';
$route['report-customization/(:any)'] = 'home/request_page/$1';
$route['inquiry-before-buying/(:any)'] = 'home/request_page/$1';
$route['request-toc/(:any)'] = 'home/request_page/$1';
/*Request pages*/

// $route['buy-now/(:any)/(:any)'] = 'home/buy_now/$1/$2';
$route['buy-now/(:any)'] = 'home/buy_now/$1';
$route['success'] = 'paypal/success';
$route['cancel'] = 'paypal/cancel';
$route['razorpay/checkout/(:any)'] = "razorpay/checkout/$1";

$route['industry-reports'] = 'home/reports_category';
$route['reports-category'] = 'home/reports_category';
$route['press-release'] = 'home/blogs';
$route['news'] = 'home/blogs';
$route['blog'] = 'home/blogs';
$route['blogs'] = 'home/blogs';
$route['sitemap.xml'] = 'home/create_sitemap';
$route['(:any)'] = 'home/page_template/$1';
$route['services/(:any)'] = 'home/page_template/$1';
$route['industry-reports/(:any)'] = 'home/industry_reports/$1';
$route['press-release/(:any)'] = 'home/blogs/$1';
$route['news/(:any)'] = 'home/blogs/$1';
$route['blog/(:any)'] = 'home/blogs/$1';
$route['blogs/(:any)'] = 'home/blogs/$1';
$route['reports-category/(:any)'] = 'home/reports_category/$1';

