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
        <meta charset="utf-8"/>
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

        <title>Editar - <?php echo $_GET['nome']; ?></title>

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
            <h2>Editar usuario: <?php echo $_GET['nome']; ?><a href="./"
                                                               class="btn btn-info btn-fab btn-fab-mini btn-round"
                                                               style="float: right;"><i class="material-icons">arrow_back</i></a>
            </h2>
            <br/>
            <br/>
            <?php
            $sql = $pdo->prepare("SELECT * FROM users WHERE name = ?");
            $sql->bindValue(1, addslashes($_GET['nome']));
            $sql->execute();
            foreach ($sql->fetchAll() as $item) {

            }
            ?>
            <h4>Nome: </h4>
            <input type="text" class="form-control" name="nome" value="<?php echo $item['name']; ?>">
            <h4>E-mail</h4>
            <input type="email" class="form-control" name="email" value="<?php echo $item['email']; ?>">
            <h4>Senha (5+ caracteres</h4>
            <input type="password" class="form-control" name="senha" value="<?php echo $item['password'] ?>"
                   minlength="5"/>

            <input class="btn btn-success" type="submit" value="Salvar alterações"/>
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>