<?php

namespace Database;

use Includer\Vars;
use PDO;

class SlimDB
{
    private static array $dir = [];
    private static string $path = __DIR__ . "/config/";

    /**
     * #SlimDB::getConfig('../db/config/settings.php');
     *
     * @param string
     * @return self|void
     */
    public static function getConfig(string $file_settings): self
    {
        $real = self::$path . $file_settings;
        if (file_exists($real)) {
            self::$dir = require_once($real);
            return new self;
        } else {
            $fake = self::$path . $file_settings;
            Vars::dump("file not found!! " . $fake, true);
        }
    }

    /**
     * @return PDO|void
     */
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
