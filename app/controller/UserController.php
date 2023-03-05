<?php

namespace App\Controller;

use PDO;
use Database\SlimDB;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController 
{
    private ?PDO $db = null;

    public function __construct()
    {
        $this->db = SlimDB::getConfig('settings.php')->connection();
    }

    public function index(Request $req, Response $resp, array $args): Response
    {
        $resp->getBody()->write('index');
        return $resp->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function showUsers(Request $req, Response $resp, array $args): Response
    {
        $users = $this->db->query("SELECT * FROM user_tb")->fetchAll(PDO::FETCH_OBJ);

        $payload = json_encode($users);
        $resp->getBody()->write($payload);

        return $resp->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function showUser(Request $req, Response $resp, array $args): Response
    {
        $user_id = $args['id'];
        $stmt = $this->db->prepare("SELECT * FROM user_tb WHERE usr_id = ?");

        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        $payload = json_encode($user);
        $resp->getBody()->write($payload);

        return $resp->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
