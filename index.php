<?php
//INICIAR una nueva session o preguntar la existencia
session_start();
if($_SESSION){
    //destruye toda la informacion registrada de una session
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Mauro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1, user-scalable=yes">
    <meta http_equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Mauro">
    <meta name="autor" content="David Benitez">
    <link rel="shortcut icon" href="/assets/img/mauro">

    <!-- Bootstrap Core CSS -->
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

<!-- MetisMenu CSS -->
<link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="./dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>
     <style>
    body{
    background:white
    }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel  panel panel-default">
                    <div class="panel-heading badge ">
                        <img width="325" height="250" src="/mauro/images/mauro.jpg" />
                        <br>
                        <br>
                        <h3 class="panel-title ">Ingrese Usuario</h3>
                    </div>
                    
                    <?php
                        //mensaje de error
                        if(!empty($_SESSION['error'])){
                            ?>
                        <div class="alert alert-dismissable" role="alert">
                            <span class="glyphicon glyphicon-remove"></span>
                            <?php echo $_SESSION['error'];?>
                            </div>
                        <?php } ?>



                    <div class="login-box-body">
                    <form action="acceso.php" method="POST">

                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="usu_nick" placeholder="Usuario" autocomplete="off" required>
                            <span class="glyphicon glyphicon-user form-control-feedback">
                            </span>
                        </div>

                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name="pass" placeholder="Contraseña" autocomplete="off" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback">
                            </span>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-lg btn-block btn-flat">Acceder</button>
                            </div>
                        </div>
                     </form>
                    </div>
                  </div>
                
                    
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="./vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>

                        </body>
    
</html>