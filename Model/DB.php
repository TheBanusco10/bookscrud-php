<?php


class DB
{

    private static $db;

    public static function connect() {

        try {
            self::$db = new PDO('mysql:host=localhost;dbname=books', 'root', 'root');

        }catch (PDOException $error) {
            echo $error->getMessage();
        }

        return self::$db;


    }


}