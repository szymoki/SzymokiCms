<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override("\App\Controllers\Home::error");
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
$routes->add('news/(\d+)', 'News::news/$1');

$routes->add('error', 'home::error');
$routes->add("panel","Panel/Panel::login");
$routes->add("panel/admin","Panel/Panel::admin");
$routes->add("panel/logout","Panel/Panel::logout");
$routes->add("panel/login","Panel/Panel::login");
$routes->add("panel/profil","Panel/Panel::profil");
$routes->add("panel/pass_change","Panel/Panel::pass_change");
$routes->add("panel/verify","Panel/Panel::verify");

$routes->add("page_p/(.+)","Page::page_p/$1");
$routes->add("page/(.+)","Page::page/$1");
$routes->add("static/(.+)","Page::static/$1");



include(APPPATH."Routes/100_autogenerate.php");


if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
