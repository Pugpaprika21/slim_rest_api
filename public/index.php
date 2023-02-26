<?php

use App\Controller\UserController;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->get('/show_users', UserController::class . ':showUsers');
$app->get('/show_user/{id}', UserController::class . ':showUser');

$app->run();
