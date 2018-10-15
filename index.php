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
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
        <link rel="ufgd icon" href="http://egressos.16mb.com/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

        <title>Administração - UFGDWiki</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>

        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

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
    <body style="background:rgba(255,255,255,0.7);">
    <div class="container">
        <?php $url = $_SERVER['BASE_URL'];?>
        <div class="header">
            <br/>
            <img src="assets/img/ufgd-universidade-federal-da-grande-dourados-logo-BA008DE1C7-seeklogo.com.png" style="width: 100px; height: 105px;">
            <h1 style="float: right;">Administração - <a onclick="let r = confirm('Deseja ir para UFGDWiki'); if(r === true) window.location.href='<?php echo $url;?>/UFGDWiki';"
                style="cursor: pointer;">UFGDWiki</a></h1>

            <br/>
            <a class="btn btn-danger btn-round" onclick="let r = confirm('Deseja sair do sistema?');
if(r === true) window.location.href='sair.php';" style="float: right">
                <i class="material-icons">exit_to_app</i> Sair
            </a>
            <br/>
            <br/>
        </div>
        <hr/>
        <h3>Usuarios</h3>

        <a class="btn btn-info btn-round" href="add-user.php" style="float: right;">
            <i class="material-icons">add</i> Adicionar usuario</a>
        <br/>
        <br/>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = $pdo->prepare("SELECT * FROM users WHERE nivel = ?");
            $sql->bindValue(1, 2);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                foreach ($sql->fetchAll() as $item) {
                    ?>
                    <tr>
                        <td>
                            <h5><?php echo $item['name']; ?></h5>
                        </td>
                        <td>
                            <h5><?php echo $item['email']; ?></h5>
                        </td>
                        <td>
                            <a class="btn btn-info btn-round btn-sm" href="editar.php?nome=<?php echo $item['name'];?>"><i class="material-icons">
                                    edit
                                </i></a>

                            <a class="btn btn-danger btn-round btn-sm" onclick="
                                    let verifica = confirm('Deseja realmente excluir o usuario: '+'<?php echo $item['name'];?>'+'?');
                                    if(verifica === true){
                                    window.location.href='excluir.php?nome=<?php echo $item['name']; ?>'
                                    }
                                    "><i class="material-icons">
                                    delete_outline
                                </i></a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>
    <?php
}
?>