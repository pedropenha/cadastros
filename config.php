<?php
try {
    $pdo = new PDO("mysql:dbname=suporte;host=localhost", "root", "1234");
} catch(PDOException $e) {
    echo "ERRO: ".$e->getMessage();
    exit;
}
