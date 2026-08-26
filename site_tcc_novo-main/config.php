<?php
// config.php
require_once 'src/Database/Connection.php'; 

try {
    $pdo = Connection::connect(); 
} catch (Exception $e) {
    die("Erro ao conectar: " . $e->getMessage());
}
?>