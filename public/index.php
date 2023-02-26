<?php

use App\Controller\UsersController;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->get('/show_users', UsersController::class . ':showUsers');
$app->get('/show_user/{id}', UsersController::class . ':showUser');

$app->run();
