<?php

use App\Controller\UserController;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->get('/', [UserController::class, 'index'])->setName('index_user');
$app->get('/show_users', [UserController::class, 'showUsers'])->setName('show_users');
$app->get('/show_user/{id}', [UserController::class, 'showUser'])->setName('show_user');

$app->run();



