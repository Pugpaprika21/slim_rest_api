<?php

namespace App\Controller;

use App\SlimQuery\SlimBuilder as SlimORM;
use PDO;
use Database\SlimDB;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends SlimController
{
    public function getFormFile(Request $req, Response $resp, array $args): Response
    {
        $files = SlimORM::table('file')
            ->where('id', '=', $args['id'])
            ->orderBy('usr_id', 'DESC')
            ->get();

        $resp->getBody()->write(json_encode($files));
        return $resp->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function showUsers(Request $req, Response $resp, array $args): Response
    {
        $users = SlimORM::table('users')->get();

        $resp->getBody()->write(json_encode($users));
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

    public function index(Request $req, Response $resp, array $args): Response
    {
        $resp->getBody()->write('index');
        return $resp->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    private ?PDO $db = null;

    public function __construct()
    {
        $this->db = SlimDB::getConfig('settings.php')->connection();
    }
}

// $users = $this->db->query("SELECT * FROM user_tb")->fetchAll(PDO::FETCH_OBJ);