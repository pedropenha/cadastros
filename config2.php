<?php
try {
    $pdo = new PDO("mysql:dbname=WikkaWiki;host=localhost", "root", "");
} catch(PDOException $e) {
    echo "ERRO: ".$e->getMessage();
    exit;
}