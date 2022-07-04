<!DOCTYPE html>
<?php
require_once '../config/loader.php';

session_start();
session_unset();
session_destroy();

$msg = filter_input(INPUT_GET, "msg");

use vendor\messages\notifications;
?>
<html>
    <head>
        <meta charset="UTF-8">

        <link href="../vendor/tws/bootstrap-4.4.1/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../vendor/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet" type="text/css"/>
        <link href="css/background.css" rel="stylesheet" type="text/css"/>

        <script src="js/jquery-3.4.1.js" type="text/javascript"></script>
        <script src="../vendor/tws/bootstrap-4.4.1/dist/js/bootstrap.js" type="text/javascript"></script>
        <script src="../vendor/jquery-validation-1.19.1/dist/jquery.validate.js" type="text/javascript"></script>
        <script src="../vendor/jquery-validation-1.19.1/dist/additional-methods.js" type="text/javascript"></script>
        <script src="../vendor/bootstrap-notify-master/bootstrap-notify.js" type="text/javascript"></script>
        <script src="js/sha512.js" type="text/javascript"></script>
        <script src="js/loginvalidar.js" type="text/javascript"></script>
        <title></title>

    </head>
    <body>
        <section class="container mt-3">
            <div class="row mt-5">
                <div class="col-md-5 mx-auto">
                    <div class="card shadow-lg">
                        <div class="card-header text-white headCard">
                            <div class="d-flex align-items-center">
                                <h5 class="mx-auto w-100">Acceso Usuarios Registrados</h5>
                                <i class="fa fa-key"></i>
                            </div>
                        </div>
                        <div class="card-body">

                            <form id="frmlogin" name="frmlogin" method="post" action="../app/ventas/controller/logincontroller.php">
                                <div class="form-group mx-auto">
                                    <div class="col-md-12">  
                                        <span class="text-danger error small"></span>
                                        <input type="text" class="form-control" id="usuario" name="usuario" 
                                               placeholder="Correo electrónico" style="border-radius: 2rem"/>
                                    </div>                           
                                </div>

                                <div class="form-group mx-auto">
                                    <div class="col-md-12">     
                                        <span class="text-danger error small"></span>
                                        <input type="password" class="form-control" id="clave" name="clave" 
                                               placeholder="Contraseña" style="border-radius: 2rem"/>
                                    </div>                           
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-warning">Iniciar sesión</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>              
            </div>

        </section>

        <footer>
            <?php
            echo notifications::show($msg, "bottom", "center")
            ?>
        </footer>

    </body>
</html>
