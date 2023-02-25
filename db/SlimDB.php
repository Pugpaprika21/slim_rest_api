<?php

namespace Database;

use Includer\Vars;
use PDO;

class SlimDB
{
    private static array $dir = [];
    /**
     * #SlimDB::getConfig('../db/config/settings.php');
     *
     * @param string $dir_settings '../db/config/settings.php'
     * @return self
     */
    public static function getConfig(string $dir_settings): self
    {
        $real = __DIR__ . "/config/" . $dir_settings;
        if (file_exists($real)) {
            self::$dir = require_once($real);
            return new self;
        } else {
            $fake = __DIR__ . "/config/" . $dir_settings;
            Vars::dump("file not found!! " . $fake, true);
        }
    }

    public static function connection(): PDO
    {
        if (is_array(self::$dir)) {

            $db = self::$dir['db'];

            $dns = "mysql:host={$db['servername']};dbname={$db['dbname']}";

            return new PDO($dns, $db['username'], $db['password'], [
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true
            ]);
        } else {
            Vars::dump(self::$dir, true);
        }
    }
}
