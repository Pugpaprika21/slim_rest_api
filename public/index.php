<?php

use App\Controller\UserController;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->get('/show_users', UserController::class . ':showUsers')->setName('user');
$app->get('/show_user/{id}', UserController::class . ':showUser')->setName('users');

$app->get('/provider_init', function (Request $request, Response $response, array $args) {
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->run();



