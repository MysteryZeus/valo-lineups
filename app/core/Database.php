<?php

class Database {
    private static $servername = '127.0.0.1';
    private static $username = 'root';
    private static $password = '';
    private static $database = 'valo_lineups';
    private static $port = 3306;
    public static $connection = NULL;
    public static $exception = NULL;
    public static $rowCount = -1;

    public static function connect() {
        try {
            self::$connection = new PDO("mysql:host=".self::$servername.";port=".self::$port.";dbname=".self::$database, self::$username, self::$password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8;"
            ]);
            return TRUE;
        } catch (PDOException $e) {
            self::$exception = $e;
        }
        return FALSE;
    }
    
    public static function insert($sql, $params = []) {
        $e = NULL;
        try {
            $statement = self::$connection->prepare($sql);

            foreach ($params as $k => $v) {
                $statement->bindValue(":$k", $v);
            }

            $statement->execute();
            self::$rowCount = $statement->rowCount();
            $stmt = NULL;
            
            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo '<br><br>';
            echo $sql;
            echo '<br><br>';
            print_r($params);
            echo '<br><br>';
            return FALSE;
        }
    }

    public static function fetch($sql, $params, $classname) {
        $e = NULL;
        try {
            $statement = self::$connection->prepare($sql);
            foreach ($params as $k => $v) {
                $statement->bindValue(":$k", $v);
            }

            $statement->execute();

            $results = $statement->fetchAll();
            self::$rowCount = $statement->rowCount();
            $stmt = NULL;

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return FALSE;
        }
    }

    public static function close() {
        if (self::$connection) {
            self::$connection = NULL;
        }
    }
}