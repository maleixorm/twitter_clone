<?php

namespace App;

use PDO;
use PDOException;

class Connection {
    public static function getDb() {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=twitter_clone;charset=utf8", "php", "123456");
            return $conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}