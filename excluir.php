<?php
session_start();
require 'config2.php';

$sql = "DELETE FROM users WHERE name = ?";
$sql = $pdo->prepare($sql);
$sql->bindValue(1, addslashes($_GET['nome']));
$sql->execute();
?>
<script>
    alert('Usuario excluido com sucesso');
    window.location.href="index.php";
</script>
