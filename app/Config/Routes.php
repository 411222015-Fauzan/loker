<?php

namespace Config;

use CodeIgniter\Config\Services;

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$routes = Services::routes();

/*
 * Default Settings
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Lowongan');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); // WAJIB false (aman & rapi)

/*
 * --------------------------------------------------------------------
 * PUBLIC ROUTES (Tanpa Login)
 * --------------------------------------------------------------------
 */

// Home / Landing Page
$routes->get('/', 'Lowongan::index');

// Auth
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');

// Test endpoint
$routes->post('/test-post', function() {
    $logger = \Config\Services::logger();
    $logger->info('TEST ENDPOINT REACHED - POST DATA: ' . json_encode($_POST));
    echo "POST received and logged!";
    exit;
});

$routes->get('/logout', 'Auth::logout');

// Lowongan
$routes->get('/lowongan', 'Lowongan::index');
$routes->get('/lowongan/search', 'Lowongan::search');
$routes->get('/lowongan/detail/(:num)', 'Lowongan::detail/$1');

// Pages
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');

/*
 * --------------------------------------------------------------------
 * PROTECTED ROUTES (WAJIB LOGIN)
 * --------------------------------------------------------------------
 */

// Dashboard (semua role)
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * PELAMAR ONLY
 * --------------------------------------------------------------------
 */
$routes->group('pelamar', ['filter' => 'auth:pelamar'], function ($routes) {
    $routes->post('apply/(:num)', 'Lamaran::apply/$1');
});

/*
 * --------------------------------------------------------------------
 * PERUSAHAAN ONLY
 * --------------------------------------------------------------------
 */
$routes->group('perusahaan', ['filter' => 'auth:perusahaan'], function ($routes) {
    $routes->get('lamaran', 'Perusahaan::lamaranMasuk');
    $routes->get('review/(:num)', 'Perusahaan::review/$1');
});

/*
 * --------------------------------------------------------------------
 * END OF FILE
 * --------------------------------------------------------------------
 */
