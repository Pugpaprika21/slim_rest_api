<?php

namespace App\Factory\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseManagerFactory
{
    public function __construct()
    {
        $capsule = new Capsule;

        /* 
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'example_db'
        */

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'example_db',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $capsule->bootEloquent();
    }
}
