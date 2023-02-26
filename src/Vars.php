<?php

namespace Includer;

class Vars
{
    private const DUMP_R_OPTION = 1;
    private const DUMP_V_OPTION = 2;

    /**
     * #Vars::dump($args);
     *
     * @param mixed $args
     * @param boolean $exist
     * @param int $dumps_opt
     * @return void
     */
    public static function dump(mixed $args, bool $exist = false, int $dumps_opt = self::DUMP_R_OPTION): void
    {
        if ($dumps_opt == 1) {
            self::dumpsArray($args, $exist);
        } else {
            self::dumpsMixed($args, $exist);
        }
    }

    /**
     * @param mixed $args
     * @param boolean $exist
     * @return void
     */
    private static function dumpsArray(mixed $args, bool $exist = false): void
    {
        $dArrayFunc = function () use ($args, $exist) {
            echo "<pre>";
            echo "<div id='debug-data' style='padding: 10px; color: #FFFFFF; background-color: #000000;'>";
            print_r($args);
            echo "</div>";
            echo "</pre>";

            if ($exist) {
                exit;
            }
        };
        $dArrayFunc();
    }

    /**
     * @param mixed $args
     * @param boolean $exist
     * @return void
     */
    private static function dumpsMixed(mixed $args, bool $exist = false): void
    {
        $dMixedFunc = function () use ($args, $exist) {
            echo "<pre>";
            echo "<div id='debug-data' style='padding: 10px; color: #FFFFFF; background-color: #000000;'>";
            var_dump($args);
            echo "</div>";
            echo "</pre>";

            if ($exist) {
                exit;
            }
        };
        $dMixedFunc();
    }
}
