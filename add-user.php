<?php
session_start();
require 'config.php';
require 'config2.php';
if(!isset($_SESSION['banco']) && empty($_SESSION['banco'])) {
    ?>
    <script>
        window.location.href="login.php";
    </script>
    <?php
}else {

    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = addslashes(MD5($_POST['senha']));

        $sql = "SELECT * FROM users WHERE name = ?";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(1, $nome);
        $sql->execute();

        if ($sql->rowCount() == 0) {
            $query = "INSERT INTO users (name, email, password, signuptime) VALUES (?,?,?, NOW())";
            $query = $pdo->prepare($query);
            $query->bindValue(1, $nome);
            $query->bindValue(2, $email);
            $query->bindValue(3, $senha);
            $query->execute();

            header("Location: index.php");
        } else {
            ?>
            <script>
                alert('Usuario ja cadastrado');
                window.location.href = "index.php";
            </script>
            <?php
        }
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

        <title>Adicionar Usuario</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>

        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

        <!-- CSS Files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="assets/css/material-kit.css" rel="stylesheet"/>

        <!--   Core JS Files   -->
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/material.min.js"></script>
        <script src="assets/js/nouislider.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="assets/js/material-kit.js" type="text/javascript"></script>
    </head>
    <body style="background-color: transparent;">
    <div class="container">
        <br/>
        <form method="POST">
            <h2>Adicionar usuarios <a href="./" class="btn btn-info btn-fab btn-fab-mini btn-round"
                                      style="float: right;"><i class="material-icons">arrow_back</i></a></h2>
            <br/>
            <br/>
            <h4>Nome: </h4>
            <input type="text" class="form-control" name="nome" placeholder="Ex: Pedro Penha">
            <h4>E-mail</h4>
            <input type="email" class="form-control" name="email" placeholder="Ex: pedro@pedro.com">
            <h4>Senha (5+ caracteres)</h4>
            <input type="password" class="form-control" name="senha" placeholder="******" minlength="5">

            <input class="btn btn-primary" type="submit" value="Adicionar"/>
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>