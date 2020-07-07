<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller']   = 'LoginController/index';
$route['logout']               = 'LoginController/logout';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

$route['init']                = 'InitController/index';
$route['check/(:any)/(:any)'] = 'InitController/check/$1/$2';

$route['office/dashboard'] = 'OfficeController/index';

$route['machine/dashboard/(:any)'] = 'MachineController/index/$1';

$route['planning']               = 'PlanningController/index';
$route['planning/update']        = 'PlanningController/update';
$route['planning/init_calendar'] = 'PlanningController/init_calendar';

$route['export']                     = 'ExportController/index';
$route['export/daily/(:any)/(:any)'] = 'ExportController/export_daily/$1/$2';
$route['export/monthly/(:any)']      = 'ExportController/export_monthly/$1';

$route['json/m1/(:any)']      = 'OfficeController/json_m1/$1';
$route['json/m2/(:any)']      = 'OfficeController/json_m2/$1';
$route['json/m3/(:any)']      = 'OfficeController/json_m3/$1';
$route['json/monthly/(:any)'] = 'OfficeController/json_montly/$1';