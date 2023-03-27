<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

    $routes->get('/', 'AuthController::login');

    $routes->group('', ['filter' => 'isLoggedIn'], function ($routes) {

    $routes->get('/dashboard', 'Dashboard::index', ['filter' => 'permission:Dashboard']);


    // GetData
    $routes->get('/wilayah/kota_by_provinsi', 'GetWilayah::KotaByProvinsi');
    $routes->get('/wilayah/kecamatan_by_kota', 'GetWilayah::KecamatanByKota');
    $routes->get('/wilayah/kelurahan_by_kecamatan', 'GetWilayah::KelurahanByKecamatan');


    // Karyawan
    $routes->get('karyawan/redirect/(:any)', 'Karyawan::redirect/$1', ['filter' => 'permission:SDM']);
    $routes->resource('karyawan', ['filter' => 'permission:SDM']);


    // Divisi
    $routes->get('divisi/redirect/(:any)', 'Divisi::redirect/$1', ['filter' => 'permission:SDM']);
    $routes->resource('divisi', ['filter' => 'permission:SDM']);


    //list
    $routes->get('list/(:num)', 'DivisiList::index/$1', ['filter' => 'permission:SDM']);
    $routes->get('detail-list/(:num)', 'DivisiList::show/$1', ['filter' => 'permission:SDM']);
    $routes->post('list/create', 'DivisiList::create', ['filter' => 'permission:SDM']);
    $routes->get('list-new/(:num)', 'DivisiList::new/$1', ['filter' => 'permission:SDM']);
    $routes->delete('list-delete/(:num)', 'DivisiList::delete/$1', ['filter' => 'permission:SDM']);

    
    //user-group
    $routes->get('user-group/(:num)', 'ListGroup::index/$1', ['filter' => 'permission:SDM']);
    $routes->post('group/create', 'ListGroup::create', ['filter' => 'permission:SDM']);
    $routes->POST('group-new', 'ListGroup::new', ['filter' => 'permission:SDM']);
    $routes->delete('group-delete/(:num)/(:num)', 'ListGroup::delete/$1/$2', ['filter' => 'permission:SDM']);


    //user-permission
    $routes->get('permission/(:num)', 'UserPermission::index/$1', ['filter' => 'permission:SDM']);
    $routes->post('permission/create', 'UserPermission::create', ['filter' => 'permission:SDM']);
    $routes->post('permission-new', 'UserPermission::new', ['filter' => 'permission:SDM']);
    $routes->delete('user-permission/(:num)/(:num)', 'UserPermission::delete/$1/$2',['filter' => 'permission:SDM']);

    
    //group-permission
    $routes->get('group-permission/(:num)', 'GroupPermission::index/$1', ['filter' => 'permission:SDM']);
    $routes->post('group-permission/create', 'GroupPermission::create', ['filter' => 'permission:SDM']);
    $routes->post('group-permission-new', 'GroupPermission::new', ['filter' => 'permission:SDM']);
    $routes->delete('group-permission/(:num)/(:num)', 'GroupPermission::delete/$1/$2',['filter' => 'permission:SDM']);


    //user
    $routes->get('user-permission-view', 'User::view_user_permission', ['filter' => 'permission:SDM']);
    $routes->get('user-group-view', 'User::view_group_user', ['filter' => 'permission:SDM']);
    $routes->get('group-permission-view', 'User::view_group_permission', ['filter' => 'permission:SDM']);
    $routes->resource('user', ['filter' => 'permission:SDM']);

    //rekrutment
    $routes->resource('rekrutmen', ['filter' => 'permission:SDM']);

    //absensi
    $routes->get('view-absensi', 'Absensi::viewAbsensi', ['filter' => 'permission:SDM']);
    $routes->get('view-laporan', 'Absensi::viewLaporan', ['filter' => 'permission:SDM']);
    $routes->resource('absensi', ['filter' => 'permission:SDM']);
    

    
});

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
