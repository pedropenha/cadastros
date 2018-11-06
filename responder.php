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
        <link rel="icon" type="image/png" href="./assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
              name='viewport'/>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css"
              href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet"/>
        <link href="assets/css/style.css" rel="stylesheet"/>
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="assets/demo/demo.css" rel="stylesheet"/>
        <title>Mensagens</title>

    </head>
    <body style="background:rgba(255,255,255,0.7);">
    <div class="container">
        <h2>Responder mensagem <a href="./" class="btn btn-info btn-fab btn-round" style="float: right;">
                <i class="material-icons">arrow_back</i>
            </a>
        </h2>
        <br/>
        <br/>
        <form method="POST">
            <?php
            $sql = "SELECT * FROM suporte.msg WHERE id = ?";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(1, addslashes($_GET['id']));
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetchAll();
                foreach ($dados as $item){}

                $query = "SELECT * FROM suporte.usuarios WHERE id = ?";
                $query = $pdo->prepare($query);
                $query->bindValue(1, $_SESSION['banco']);
                $query->execute();

                if(isset($_POST['resposta']) && !empty($_POST['resposta'])){
                    $resposta = "Re: ";
                    $resposta .= addslashes($_POST['resposta']);

                    $response = "INSERT INTO suporte.msg_resposta (usr_remetente, assunto, msg_anterior, resposta, dia_resposta) VALUES (?,?,?,?,NOW())";
                    $response = $pdo->prepare($response);
                    $response->bindValue(1, $item['usuario']);
                    $response->bindValue(2, $item['assunto']);
                    $response->bindValue(3, $item['mensagem']);
                    $response->bindValue(4, $resposta);
                    $response->execute();

                    $up = "UPDATE suporte.msg SET respondida = 1 WHERE id = ?";
                    $up = $pdo->prepare($up);
                    $up->bindValue(1, $_SESSION['banco']);
                    $up->execute();

                    ?>
                    <script>
                        alert('Mensagem respondida');
                        window.location.href='mensagens.php';
                    </script>
                    <?php
                }
            }else{
                header("Location: index.php");
            }
            ?>
            <h3>Usuario remetente</h3>
            <input type="text" class="form-control" value="<?php echo $item['usuario'];?>" disabled/>
            <h3>Assunto</h3>
            <input type="text" class="form-control" value="<?php echo $item['assunto']; ?>" disabled/>
            <h3>Mensagem</h3>
            <textarea class="form-control" disabled><?php echo $item['mensagem'];?></textarea>
            <h3>Resposta*</h3>
            <textarea class="form-control" placeholder="Digite sua resposta para a mensagem acima" name="resposta" required autofocus></textarea>
            <br/>
            <input type="submit" class="btn btn-success btn-round float-right" value="Responder"/>
            <br/>
            <br/>
        </form>
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