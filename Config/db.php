<?php

/**
 * Connection class. Will likely override using the mysqli class from Assignment 1
 */
class Database
{
    private static $bdd = null;

    private function __construct() {
    }

    public static function getBdd() {
        if(is_null(self::$bdd)) {
            $dbConfigs = parse_ini_file('../Config/config.ini');
            self::$bdd = new mysqli($dbConfigs['servername'], $dbConfigs['username'], $dbConfigs['password'], $dbConfigs['dbname']);
        }
        return self::$bdd;
    }
}
?>