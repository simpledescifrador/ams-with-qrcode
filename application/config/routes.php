<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';//index page ng site
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/* ---------- API ROUTES ---------------*/
$route['api/v1/attendance/add']['post'] = 'api/attendance_api/add_attendance';
$route['api/v1/qrcode/(:any)/status']['get'] = 'api/attendance_api/check_qrcode_status/$1';

/* ---------- WEB ROUTES ---------------*/

//Authentication Controller Routes
$route['login'] = 'web/authentication/login';
$route['forgot'] = 'web/authentication/forgot_password';
$route['login/auth'] = 'web/authentication/login_auth';
$route['logout'] = 'web/authentication/logout';
$route['change-password'] = 'web/authentication/change_password';

//Dashboard Controller Routes
$route['dashboard'] = 'web/dashboard/page';
$route['dashboard/(:any)'] = 'web/dashboard/page/$1';

/* END OF API ROUTES */

