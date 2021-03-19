<?php

namespace App\Utils\Dev;


class VarDumper{
    public static function dump($var):void
    {
        echo '<pre>';
        print_r( $var);
        echo '</pre>';
    }

    public static function dd($var):void
    {
        self::dump($var);
        die();
    }
}