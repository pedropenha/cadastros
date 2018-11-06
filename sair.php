<?php
session_start();

unset($_SESSION['banco']);
$url = $_SERVER['BASE_URL'];
header("Location: ".$url."/UFGDWiki");
exit;