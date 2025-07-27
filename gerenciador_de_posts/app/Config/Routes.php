<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ROTAS USUÁRIO
$routes->get('/', function () {
    if (session()->has('user_id')) {
        return redirect()->to('/posts');
    }
    return redirect()->to('/login');
});

$routes->get('/register', 'UserController::registerForm');
$routes->post('/register', 'UserController::register');
$routes->get('/login', 'UserController::loginForm');
$routes->post('/login', 'UserController::login');
$routes->get('/logout', 'UserController::logout');

// ROTAS POSTS
$routes->group('posts', function ($routes) {
    $routes->get('/', 'PostController::index');
    $routes->get('create', 'PostController::create');
    $routes->post('store', 'PostController::store');
    $routes->get('show/(:num)', 'PostController::show/$1');
    $routes->get('edit/(:num)', 'PostController::edit/$1');
    $routes->post('update/(:num)', 'PostController::update/$1');
    $routes->post('delete/(:num)', 'PostController::delete/$1');
});

// ROTA AJAX DINÂMICA
$routes->get('posts/search/ajax', 'PostController::searchAjax');

// ROTA API COM CORS
$routes->group('api', [
    'namespace' => 'App\Controllers\Api',
], function ($routes) {
    $routes->get('posts', 'PostController::index');
    $routes->get('posts/(:num)', 'PostController::show/$1');
    $routes->get('users', 'UserController::index');
});


