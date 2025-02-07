<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['login'] = 'auth';
$route['logout'] = 'auth/logout';
$route['account'] = 'auth/account';

$route['forgot-password'] = 'auth/forgot';
$route['reset-password/(:any)'] = 'auth/reset/$1';

$route['service-details'] = "ServiceDetails/index";
$route['service-details/(:any)'] = "ServiceDetails/$1";
$route['service-details/(:any)/(:any)'] = "ServiceDetails/$1/$2";


$route['update-profile'] = 'auth/updateProfile';

$route['report-transactions'] = 'reports';
$route['setting/save-access'] = 'setting/saveAccess';
$route['report-transactions/(:any)'] = 'reports/$1';
$route['get-data-penghasilan/(:any)'] = 'dashboard/getDataPenghasilan/$1';

$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
