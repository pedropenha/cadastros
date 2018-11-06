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
    <div class="container">
        <?php $url = $_SERVER['BASE_URL'];?>
        <div class="header">
            <br/>
            <img src="assets/img/ufgd-universidade-federal-da-grande-dourados-logo-BA008DE1C7-seeklogo.com.png" style="width: 100px; height: 105px;">
            <h1 style="float: right;">Administração - <a class="link-hover" onclick="let r = confirm('Deseja ir para UFGDWiki'); if(r === true) window.location.href='<?php echo $url;?>/UFGDWiki';">UFGDWiki</a></h1>

            <br/>
            <a class="btn btn-danger btn-round text-button" onclick="let r = confirm('Deseja sair do sistema?');
if(r === true) window.location.href='sair.php';" style="float: right">
                <i class="material-icons">exit_to_app</i> Sair
            </a>
            <br/>
            <br/>
        </div>
        <hr/>
        <a class="btn btn-info btn-round" href="add-user.php" style="float: right;">
            <i class="material-icons">add</i> Adicionar usuario</a>
        <a class="btn btn-success btn-round" href="mensagens.php" style="float: left;"><i class="material-icons">
                message
            </i> Mensagens</a>
        <br/>
        <br/>
        <br/>
        <hr/>
        <h3>Usuarios</h3>
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

                            <a class="btn btn-danger btn-round btn-sm text-button" onclick="
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
    <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins/moment.min.js"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--	Plugin for Sharrre btn -->
    <script src="assets/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/material-kit.js?v=2.0.4" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            //init DateTimePickers
            materialKit.initFormExtendedDatetimepickers();

            // Sliders Init
            materialKit.initSliders();
        });


        function scrollToDownload() {
            if ($('.section-download').length != 0) {
                $("html, body").animate({
                    scrollTop: $('.section-download').offset().top
                }, 1000);
            }
        }


        $(document).ready(function() {

            $('#facebook').sharrre({
                share: {
                    facebook: true
                },
                enableHover: false,
                enableTracking: false,
                enableCounter: false,
                click: function(api, options) {
                    api.simulateClick();
                    api.openPopup('facebook');
                },
                template: '<i class="fab fa-facebook-f"></i> Facebook',
                url: 'https://demos.creative-tim.com/material-kit/index.html'
            });

            $('#googlePlus').sharrre({
                share: {
                    googlePlus: true
                },
                enableCounter: false,
                enableHover: false,
                enableTracking: true,
                click: function(api, options) {
                    api.simulateClick();
                    api.openPopup('googlePlus');
                },
                template: '<i class="fab fa-google-plus"></i> Google',
                url: 'https://demos.creative-tim.com/material-kit/index.html'
            });

            $('#twitter').sharrre({
                share: {
                    twitter: true
                },
                enableHover: false,
                enableTracking: false,
                enableCounter: false,
                buttons: {
                    twitter: {
                        via: 'CreativeTim'
                    }
                },
                click: function(api, options) {
                    api.simulateClick();
                    api.openPopup('twitter');
                },
                template: '<i class="fab fa-twitter"></i> Twitter',
                url: 'https://demos.creative-tim.com/material-kit/index.html'
            });

        });
    </script>
    </body>
    </html>
    <?php
}
?>