<?php
session_start();
require 'config.php';

if(isset($_POST['email']) && !empty($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $sql->bindValue(1, $email);
    $sql->bindValue(2, md5($senha));
    $sql->execute();

    if($sql->rowCount() > 0) {
        $sql = $sql->fetch();

        $_SESSION['banco'] = $sql['id'];
        header("Location: index.php");
        exit;
    }


}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Login - Administração</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/material.min.js"></script>
    <script src="assets/js/nouislider.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="assets/js/material-kit.js" type="text/javascript"></script>

</head>
<body class="signup-page">
<div class="wrapper">
    <div class="header header-filter" style="background-image: url('assets/img/city.jpg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="card card-signup">
                        <form class="form" method="POST">
                            <div class="header header-info text-center">
                                <h4>Painel de Administração</h4>
                            </div>
                            <div class="content">

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
                                    <input type="text" class="form-control" placeholder="E-mail" name="email"/>
                                </div>

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
                                    <input type="password" placeholder="Senha" class="form-control" name="senha"/>
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-success btn-round">
                                     Entrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>