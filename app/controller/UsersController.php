<?php

namespace App\Controller;

use PDO;
use Database\SlimDB;
use Includer\Vars;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersController
{
    private $db = null;

    public function __construct()
    {
        $this->db = SlimDB::getConfig('settings.php')->connection();
    }

    public function showUsers(Request $request, Response $response, array $args)
    {
        $users = $this->db->query("SELECT * FROM user_tb")->fetchAll(PDO::FETCH_OBJ);

        $payload = json_encode($users);
        $response->getBody()->write($payload);
        
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function showUser(Request $request, Response $response, array $args)
    {
        $user_id = $args['id'];
        $stmt = $this->db->prepare("SELECT * FROM user_tb WHERE usr_id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        $payload = json_encode($user);
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
