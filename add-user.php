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

            $query = "INSERT INTO suporte.usuarios(nome, email, senha) VALUES (?,?,?)";
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
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="./assets/img/ufgd-universidade-federal-da-grande-dourados-logo-BA008DE1C7-seeklogo.com.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet"/>
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="assets/demo/demo.css" rel="stylesheet" />
        <title>Adicionar usuario</title>
    </head>
    <body style="background-color: white">
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container">
            <a class="navbar-brand" href="/cadastros" style="color: white !important;">Administração - UFGDWiki</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="material-icons text-light">
                    menu
                </i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color: white;"><i class="material-icons">home</i> Página principal  <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="add-user.php"><i class="material-icons">add</i> Adicionar usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mensagens.php"><i class="material-icons">message</i> Mensagens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-nav" onclick="let r = confirm('Deseja sair do sistema?');
                            if(r === true) window.location.href='sair.php';">
                            <i class="material-icons">exit_to_app</i> Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <br/>
        <form method="POST">
            <h2>Adicionar usuarios</h2>
            <br/>
            <h3>Nome: </h3>
            <input type="text" class="form-control" name="nome" placeholder="Ex: Pedro Penha">
            <h3>E-mail:</h3>
            <input type="email" class="form-control" name="email" placeholder="Ex: pedro@pedro.com">
            <h3>Senha (5+ caracteres):</h3>
            <input type="password" class="form-control" name="senha" placeholder="******" minlength="5">
            <br/>
            <input class="btn btn-info btn-round float-right" type="submit" value="Adicionar"/>
            <br/>
            <br/>
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>