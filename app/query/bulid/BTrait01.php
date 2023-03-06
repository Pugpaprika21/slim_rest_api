<?php

namespace App\SlimQuery\Bulid;

trait BTrait01
{
    use TraitMain;

    public static function table(string $table): ?self
    {
        if ($table != '') {
            $tblFind = null;
            $tblList = self::listTable();

            foreach ($tblList as $tbName => $v) {
                if ($tblList[$tbName] == $table) {
                    $tblFind = $table;
                    break;
                }
            }

            if (!is_null($tblFind)) {
                self::$setTbl = $table;
                return new self;
            }
            return null;
        }
        self::$setTbl = '';
        return null;
    }

    public function select(string $fields = "*"): ?self
    {
        if (self::$setTbl != '') {
            $tbl = self::$setTbl;
        }

        $stmt = "SELECT {$fields} FROM {$tbl} ";

        if ($fields != '*') {
        }
        return null;
    }

    public function where(string $condit1 = '', string $condit2 = '', string $val = '')
    {
        return new self;
    }

    public function orderBy(string $condit1 = '', string $condit2 = '', string $val = '')
    {

        return new self;
    }

    public function get($callback = null)
    {

        $callback(new self());
    }
}
