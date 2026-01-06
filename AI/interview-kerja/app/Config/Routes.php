<?php

use App\Controllers\ApiController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [ApiController::class, "newChat"]);
$routes->get('/c/(:num)', [ApiController::class, "index/$1"]);
$routes->group('api/v1', function () use ($routes) {
    $routes->post('send', [ApiController::class, 'sendAfterPrompt']);
    $routes->post('send/(:num)/user', [ApiController::class, 'sendAfterPrompt/$1']);
    $routes->get('send/(:num)/bot', [ApiController::class, 'send/$1']);
});

// stopped
$routes->get('/stop', [ApiController::class, "stoped"]);
