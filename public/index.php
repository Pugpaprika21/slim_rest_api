<?php

use Database\SlimDB;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$db = SlimDB::getConfig('settings.php')->connection();

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->get('/show_users', function (Request $request, Response $response, array $args) {
    global $db;

    $users = $db->query("SELECT * FROM user_tb")->fetchAll(PDO::FETCH_OBJ);

    $payload = json_encode($users);
    $response->getBody()->write($payload);
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(201);
});

$app->get('/show_user/{id}', function (Request $request, Response $response, array $args) {
    global $db;

    $user_id = $args['id'];
    $stmt = $db->prepare("SELECT * FROM user_tb WHERE id = ?");
    $stmt->execute([$user_id]);
    $user  = $stmt->fetch();
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(201);
});

$app->run();
