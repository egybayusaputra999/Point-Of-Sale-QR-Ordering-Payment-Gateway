<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Dashboard::index');
$routes->get('/antrian/(:any)', 'Antrian::index');
$routes->get('/laporan/(:any)', 'Laporan::index');

$routes->get('/menu/(:any)', 'Menu::index');
$routes->get('/user/(:any)', 'User::index');
$routes->get('/menuKasir/(:any)', 'MenuKasir::index');
$routes->get('/menuKaryawan/(:any)', 'MenuKaryawan::index');

// Barcode routes
$routes->group('dashboard', function($routes) {
    $routes->get('barcode', 'Barcode::index');
    $routes->get('barcode/generate', 'Barcode::generate');
    $routes->get('barcode/regenerate/(:num)', 'Barcode::regenerate/$1');
    $routes->get('barcode/toggle/(:num)', 'Barcode::toggle/$1');
});

// Payment routes
$routes->group('payment', function($routes) {
    $routes->get('/', 'Payment::index');
    $routes->post('createSnapToken', 'Payment::createSnapToken');
    $routes->post('notification', 'Payment::notification');
    $routes->get('checkStatus/(:any)', 'Payment::checkStatus/$1');
});

// Public order routes
$routes->get('order/([a-zA-Z0-9_]+)', 'Barcode::order/$1');
$routes->post('order/submit', 'Barcode::submitOrder');
$routes->post('/barcode/tambahPesanan', 'Barcode::tambahPesanan');

// Payment routes removed - Midtrans integration disabled

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
