<?php

namespace App\Controller;

use App\SlimQuery\SlimBuilder as Bulider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends SlimController
{
    public function getFormFile(Request $req, Response $resp, array $args): Response
    {
        $file = Bulider::table('file')
            ->where('id', '=', $args['id'])
            ->orderBy('usr_id', 'DESC')
            ->get();

        $files = Bulider::table('file_user')
            ->join('file', 'file_user.id', '=', 'file.id')
            ->join('file', 'file_user.prof_id', '=', 'file.prof_id')
            ->where('file.usr_id', $file['id'])
            ->get();

        $fileResp = array_merge(['single_file' => $file, 'all_file' => $files]);
        
        $resp->getBody()->write(json_encode($fileResp));
        return $resp->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function showUsers(Request $req, Response $resp, array $args): Response
    {
        $users = Bulider::table('users')->get();

        $resp->getBody()->write(json_encode($users));
        return $resp->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function showUser(Request $req, Response $resp, array $args): Response
    {
        $user = Bulider::table('user')->where('id', '=', $args['id'])->get();

        $payload = json_encode($user);
        $resp->getBody()->write($payload);
        return $resp->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    // public function index(Request $req, Response $resp, array $args): Response
    // {
    //     $resp->getBody()->write('index');
    //     return $resp->withHeader('Content-Type', 'application/json')->withStatus(201);
    // }

    // use PDO;
    // private ?PDO $db = null;

    // public function __construct()
    // {
    //     $this->db = SlimDB::getConfig('settings.php')->connection();
    // }

    // $stmt = $this->db->prepare("SELECT * FROM user_tb WHERE usr_id = ?");

    // $stmt->execute([$user_id]);
    // $user = $stmt->fetch(PDO::FETCH_OBJ);
}

// $users = $this->db->query("SELECT * FROM user_tb")->fetchAll(PDO::FETCH_OBJ);