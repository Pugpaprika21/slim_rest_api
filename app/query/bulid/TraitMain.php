<?php

namespace App\SlimQuery\Bulid;

use Database\SlimDB;
use PDO;
use Throwable;

trait TraitMain
{
    public static string $setTbl  = '';
    public static string $setFields  = '';

    public static function listTable(): array
    {
        $tableList = [];
        $query = self::conn()->query('SHOW TABLES');
        while ($tables = $query->fetch(PDO::FETCH_NUM)) {
            array_push($tableList, $tables[0]);
        }
        return $tableList;
    }

    protected static function conn(): ?PDO
    {
        try {
            $conn = SlimDB::getConfig('settings.php')->connection();
            return $conn;
        } catch (Throwable $th) {
            return null;
        }
    }
}
