<?php
session_start();
require 'config2.php';
if(!isset($_SESSION['banco']) && empty($_SESSION['banco'])) {
    ?>
    <script>
        window.location.href="login.php";
    </script>
    <?php
}else {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="./assets/img/favicon.png">
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
        <title>Administração</title>
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
                    <li class="nav-item">
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
            <?php
            if (isset($_POST['nome']) && !empty($_POST['nome'])) {
                if (empty($_POST['senha'])) {
                    $nome = addslashes($_POST['nome']);
                    $email = addslashes($_POST['email']);

                    $sql = "UPDATE users SET name = ?, email = ? WHERE name = ?";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(1, addslashes($_POST['nome']));
                    $sql->bindValue(2, addslashes($_POST['email']));
                    $sql->bindValue(3, addslashes($_GET['nome']));
                    $sql->execute();

                    header("Location: index.php");
                } else {
                    $nome = addslashes($_POST['nome']);
                    $email = addslashes($_POST['email']);

                    $sql = "UPDATE users SET name = ?, email = ?, password = ? WHERE name = ?";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(1, addslashes($_POST['nome']));
                    $sql->bindValue(2, addslashes($_POST['email']));
                    $sql->bindValue(3, addslashes(MD5($_POST['senha'])));
                    $sql->bindValue(4, addslashes($_GET['nome']));
                    $sql->execute();

                    header("Location: index.php");
                }
            }
            ?>
            <h2>Editar usuario: <?php echo $_GET['nome']; ?></h2>
            <br/>
            <?php
            $sql = $pdo->prepare("SELECT * FROM users WHERE name = ?");
            $sql->bindValue(1, addslashes($_GET['nome']));
            $sql->execute();
            foreach ($sql->fetchAll() as $item) {

            }
            ?>
            <h3>Nome: </h3>
            <input type="text" class="form-control" name="nome" value="<?php echo $item['name']; ?>">
            <h3>E-mail</h3>
            <input type="email" class="form-control" name="email" value="<?php echo $item['email']; ?>">
            <h3>Senha (5+ caracteres)</h3>
            <input type="password" class="form-control" name="senha" minlength="5"/>
            <br/>
            <input class="btn btn-success btn-round float-right" type="submit" value="Salvar alterações"/>
            <br/>
            <br/>
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>