<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


$route['default_controller'] = "login";
$route['404_override'] = '';
$route['no_access_ip/(:any)'] = "no_access/ip_restriction/$1";
$route['no_access/(:any)'] = "no_access/index/$1";
$route['r/(:any)'] = "public_view/receipt/$1";
$route['i/(:any)'] = "public_view/pay_receipt/$1";
$route['payment_success/(:any)'] = "public_view/view_payment_receipt/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */

$route['billing']                      = 'billing/index';
$route['billing/index']                = 'billing/index';
$route['billing/ver_en_siat/(:num)']   = 'billing/ver_en_siat/$1';
$route['billing/imprimir_ticket/(:num)']  = 'billing/imprimir_ticket/$1';
$route['billing/imprimir_pagina/(:num)']  = 'billing/imprimir_pagina/$1';
$route['billing/anular_factura']          = 'billing/anular_factura';        // AJAX POST
$route['billing/revertir_factura/(:num)'] = 'billing/revertir_factura/$1';
$route['billing/enviar_email']            = 'billing/enviar_email';          // AJAX POST
$route['billing/ver_xml/(:any)']          = 'billing/ver_xml/$1';
