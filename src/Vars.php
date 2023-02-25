<?php

namespace Includer;

class Vars
{
    private static $dd;
    /**
     * #Vars::dump($args);
     *
     * @param mixed $args
     * @param boolean $exist
     * @return void
     */
    public static function dump(mixed $args, bool $exist = false): void
    {
        $dumps = function (mixed $args, bool $exist = false) {
            echo "<pre>";
            echo "<div id='debug-data' style='padding: 10px; color: #FFFFFF; background-color: #000000;'>";
            print_r($args);
            echo "</div>";
            echo "</pre>";

            if ($exist) exit;
        };

        $dumps($args, $exist);
    }
}
