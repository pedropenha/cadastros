<?php
try {
    $pdo = new PDO("mysql:dbname=wikka;host=localhost", "root", "");
} catch(PDOException $e) {
    echo "ERRO: ".$e->getMessage();
    exit;
}
