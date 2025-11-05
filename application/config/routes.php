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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['logout'] = 'login/logout'; 

$route['change-password'] = 'login/change_password';

$route['ams-category-list'] = 'master/category_list';
$route['ams-category-list/(:num)'] = 'master/category_list/$1';   

$route['ams-location-list'] = 'master/location_list';
$route['ams-location-list/(:num)'] = 'master/location_list/$1';  

$route['ams-asset-item-list'] = 'master/asset_item_list';
$route['ams-asset-item-list/(:num)'] = 'master/asset_item_list/$1';  

$route['ams-asset-qrcode-list/(:num)'] = 'master/asset_qrcode_list/$1';  

$route['print-asset-qrcode/(:num)'] = 'master/print_qrcode/$1';  
$route['print-asset-qrcode-v2/(:num)'] = 'master/print_qrcode_v2/$1';  

 
 

$route['staff-attendance-list'] = 'staff/staff_attendance_list';   
$route['staff-attendance-list/(:num)'] = 'staff/staff_attendance_list/$1';   

$route['staff-attendance-chart'] = 'staff/staff_attendance_chart';   

$route['attendance-import'] = 'staff/attendance_import';   
$route['attendance-import-xls'] = 'staff/attendance_import_xls';   
$route['staff-salary'] = 'staff/staff_salary';   
$route['staff-calender'] = 'staff/staff_calender';   
$route['print-payslip/(:num)'] = 'staff/print_payslip/$1';    

$route['attendance-calender/(:num)/(:any)'] = 'staff/attendance_calender/$1/$2';   

$route['salary-bank-submission'] = 'staff/salary_bank_submission';   
$route['salary-bank-submission-report'] = 'staff/salary_bank_submission_report';  

$route['print-bank-submission/(:num)'] = 'staff/print_bank_submission/$1';  

 
$route['staff-leave-summary'] = 'reports/staff_leave_summary';   
$route['staff-salary-summary'] = 'reports/staff_salary_summary';   
$route['staff-identity-data'] = 'reports/staff_identity_data';   
$route['staff-profile'] = 'reports/staff_profile';   
$route['staff-information/(:num)'] = 'reports/staff_information/$1';   


$route['notice-board-list'] = 'master/notice_board_list';
$route['notice-board-list/(:num)'] = 'master/notice_board_list/$1';
   


$route['dash'] = 'dashboard'; 
$route['staff-dash'] = 'dashboard/staff_dashboard'; 

$route['get-data'] = 'general/get_data';
$route['update-data'] = 'general/update_data';
$route['insert-data'] = 'general/insert_data';
$route['delete-record'] = 'general/delete_record';
$route['get-content'] = 'general/get_content';  
$route['get-calender-data'] = 'general/get_calender_data';  

$route['get-notice'] = 'general/get_notice';


$route['hd-category-list'] = 'helpdesk/hd_category_list'; 
$route['hd-category-list/(:num)'] = 'helpdesk/hd_category_list/$1'; 

$route['ticket-list'] = 'helpdesk/ticket_list'; 
$route['ticket-list/(:num)'] = 'helpdesk/ticket_list/$1';

$route['ticket/(:num)'] = 'helpdesk/ticket_info/$1';


 
