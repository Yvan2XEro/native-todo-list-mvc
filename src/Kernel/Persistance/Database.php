<?php

namespace App\Kernel\Persistance;

use PDO;

class Database
{

    /**
     * @var PDO
     */
    private static $pdo = null;

    public static function initPDO($dbname = '', $username = 'root', $password = '', $host = null, $port = '3306')
    {
        if ('' == $host)
            $host   = '127.0.0.1';
        if ('' == $dbname)
            $dbname = 'todolist';

        $dsn    = "mysql:host=$host;port=$port;dbname=$dbname;charst=utf8";
        self::$pdo  = new PDO($dsn, $username, $password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return PDO
     */
    public static function getPDO($dbname = '', $username = 'root', $password = '', $host = null, $port = '3306'):PDO
    {
        if (null == self::$pdo)
            self::initPDO($dbname, $username, $password, $host, $port);
        return self::$pdo;
    }
}
