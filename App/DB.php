<?php

namespace App;

use PDO;

class DB
{
    private static $pdo;
    
    public static function init($config)
    {
        // Создаем PDO соединение
        self::$pdo = new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);
        // Задаем режим выборки по умолчанию
        self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    
    public static function returnResFromDatabase($a, $b, $c)
    {
        $statement = self::$pdo->query("SELECT res_x1, res_x2 FROM equations where param_a = $a and param_b = $b and param_c = $c");
        $res = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$res) {
            return null;
        }

        return [
            "x1" => $res["res_x1"],
            "x2" => $res["res_x2"]
        ];
    }
    
    public static function insertNewEquation($a, $b, $c, $x1, $x2)
    {
        $statement = self::$pdo->query("INSERT INTO equations VALUES($a, $b, $c, '$x1', '$x2')");
        return $statement->execute();
    }
}