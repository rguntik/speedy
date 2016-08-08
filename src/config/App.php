<?php
/**
 * Created by PhpStorm.
 * User: spiker
 * Date: 01.08.16
 * Time: 21:48
 */

namespace speedy\config;

class App {

    protected static $config = null;
    protected static $instance = null;

    public static function conf($attr)
    {
        if (!isset(self::$config)) {
            self::$config = include('config.php');
        }
        return isset(self::$config[$attr])? self::$config[$attr] : false;
    }

    public static function db()
    {
        try {
            if (!isset(self::$instance)) {
                $dbName = App::conf('db')['name'];
                self::$instance = new \PDO('sqlite:'.$dbName) or die("failed to open/create the database ".$dbName);
            }
            return self::$instance;
        }
        catch(\PDOException $e) {
            die("failed to open/create the database");
        }
    }
}