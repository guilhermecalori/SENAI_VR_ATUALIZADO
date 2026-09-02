<?php
// src/Database/Connection.php
class Connection {
    public static function connect() {
        $host = "localhost";
        $db   = "projeto_senai"; 
        $user = "root";
        $pass = "12345678";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro na ligação: " . $e->getMessage());
        }
    }
}