<?php

namespace App\SlimQuery\Factory;

use App\SlimQuery\Bulid\TraitMain;
use PDO;

class SlimBuilderFactory
{
    use TraitMain;

    protected static function appFactory()
    {
        return [];
    }
}
