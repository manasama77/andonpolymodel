<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller']   = 'LoginController/index';
$route['logout']               = 'LoginController/logout';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

$route['init']                = 'InitController/index';
$route['check/(:any)/(:any)'] = 'InitController/check/$1/$2';

$route['office/dashboard'] = 'OfficeController/index';
$route['office/dashboard2'] = 'OfficeController/index2';

$route['machine/dashboard/(:any)'] = 'MachineController/index/$1';

$route['planning']               = 'PlanningController/index';
$route['planning/update1']        = 'PlanningController/update1';
$route['planning/update2']        = 'PlanningController/update2';
$route['planning/update3']        = 'PlanningController/update3';
$route['planning/init_calendar1'] = 'PlanningController/init_calendar1';
$route['planning/init_calendar2'] = 'PlanningController/init_calendar2';
$route['planning/init_calendar3'] = 'PlanningController/init_calendar3';

$route['export']                     = 'ExportController/index';
$route['export/daily/(:any)/(:any)'] = 'ExportController/export_daily/$1/$2';
$route['export/monthly/(:any)']      = 'ExportController/export_monthly/$1';

$route['json/m1/(:any)']      = 'OfficeController/json_m1/$1';
$route['json/m2/(:any)']      = 'OfficeController/json_m2/$1';
$route['json/m3/(:any)']      = 'OfficeController/json_m3/$1';
$route['json/monthly/(:any)'] = 'OfficeController/json_montly/$1';

$route['image_upload'] = 'UploadController/index';
$route['image_delete'] = 'UploadController/destroy';
