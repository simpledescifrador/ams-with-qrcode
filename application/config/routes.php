<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'main';//index page ng site
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/* ---------- API ROUTES ---------------*/
$route['api/v1/attendance/add']['post'] = 'api/attendance_api/add_attendance';
$route['api/v1/qrcode/(:any)/status']['get'] = 'api/attendance_api/check_qrcode_status/$1';

/* ---------- WEB ROUTES ---------------*/

//Authentication Controller Routes
$route['login'] = 'web/authentication/login';
$route['register'] = 'web/authentication/register';
$route['forgot'] = 'web/authentication/forgot_password';
$route['login/auth'] = 'web/authentication/login_auth';
$route['register/auth'] = 'web/authentication/register_auth';
$route['logout'] = 'web/authentication/logout';
$route['change-password'] = 'web/authentication/change_password';

//Dashboard Controller Routes
$route['dashboard'] = 'web/dashboard/page';
$route['dashboard/(:any)'] = 'web/dashboard/page/$1';

//Section Controller Routes
$route['sections/new'] = 'web/section/new_section';
$route['sections/(:num)/edit'] = 'web/section/edit_section_details/$1';
$route['sections/(:num)/delete'] = 'web/section/remove_section/$1';
$route['dashboard/sections/(:num)'] = 'web/section/view_section_details/$1';
$route['sections/(:num)/students'] = 'web/section/get_section_students/$1';

//Student Controller Routes
$route['students/new'] = 'web/student/new_student';
$route['students/(:num)/edit'] = 'web/student/edit_student_details/$1';
$route['students/(:num)/delete'] = 'web/student/remove_student/$1';
$route['dashboard/students/(:num)'] = 'web/student/view_student_profile/$1';


//Attendance Controller Routes
$route['attendance/new'] = 'web/attendance/new_attendance';
$route['attendance/(:num)/edit'] = 'web/attendance/edit_attendance/$1';
$route['attendance/(:num)/delete'] = 'web/attendance/remove_attendance/$1';
$route['attendance/mark'] = 'web/attendance/mark_attendance';
$route['dashboard/attendance/view'] = 'web/attendance/view_attendance';
$route['dashboard/generate/attendance'] = 'web/attendance/generate_attendance';

//Recitation Controller Routes
$route['recitations/new'] = 'web/recitation/new_recitation';
$route['recitations/(:num)/edit'] = 'web/recitation/edit_recitation/$1';
$route['recitations/(:num)/delete'] = 'web/recitation/remove_recitation/$1';
$route['dashboard/generate/recitation'] = 'web/recitation/generate_report';

//Render Qrcodes Routes
$route['qrcodes/students/(:num)'] = 'web/render_qrcode/generate_student_qrcode/$1';

//Generate Reports
$route['generate/students/qrcode/(:any)'] = 'web/report_generator/student_qrcode_to_pdf/$1';
$route['generate/section/qrcode/(:num)'] = 'web/report_generator/section_qrcode_to_pdf/$1';
$route['generate/students/(:num)/attendance'] = 'web/report_generator/student_attendance/$1';
$route['generate/sections/(:num)/attendance'] = 'web/report_generator/monthly_section_attendance/$1';
/* END OF API ROUTES */

