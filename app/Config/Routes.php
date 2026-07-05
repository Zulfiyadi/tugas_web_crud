<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Home Routes
$routes->get('/', 'Home::index');
$routes->get('/kontak', 'Home::kontak');

// Auth Routes
$routes->group('auth', function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::register');
    $routes->get('logout', 'Auth::logout');
});

// Paket Layanan Routes
$routes->group('paket', function ($routes) {
    $routes->get('', 'Paket::index');
    $routes->get('create', 'Paket::create');
    $routes->post('create', 'Paket::create');
    $routes->get('edit/(:num)', 'Paket::edit/$1');
    $routes->post('edit/(:num)', 'Paket::edit/$1');
    $routes->get('delete/(:num)', 'Paket::delete/$1');
    $routes->get('exportPdf', 'Paket::exportPdf');
});

// Orders Routes
$routes->group('orders', function ($routes) {
    $routes->get('', 'Orders::index');
    $routes->get('create', 'Orders::create');
    $routes->post('create', 'Orders::create');
    $routes->get('edit/(:num)', 'Orders::edit/$1');
    $routes->post('edit/(:num)', 'Orders::edit/$1');
    $routes->get('delete/(:num)', 'Orders::delete/$1');
    $routes->post('cart/add', 'Orders::addToCart');
    $routes->post('cart/update', 'Orders::updateCart');
    $routes->post('cart/remove', 'Orders::removeFromCart');
    $routes->post('cart/destroy', 'Orders::destroyCart');
});
