<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");

use app\ventas\model\tax;
use app\ventas\controller\taxcontroller;
use vendor\messages\notifications;

$codTipo = filter_input(INPUT_GET, "cod");

$taxObj = new tax();
$controllerObj = new taxcontroller();

$taxObj->set_idTax($codTipo);
$taxObj = $controllerObj->getOne($taxObj);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    <link href="../../../../vendor/tws/bootstrap-4.4.1/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../../../../vendor/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>

        <script src="../../../../public/js/jquery-3.4.1.js" type="text/javascript"></script>
        <script src="../../../../vendor/fontawesome-free-5.15.3-web/js/all.js" type="text/javascript"></script>
        <script src="../../../../vendor/tws/bootstrap-4.4.1/dist/js/bootstrap.js" type="text/javascript"></script>
        <script src="../../../../vendor/jquery-validation-1.19.1/dist/jquery.validate.js" type="text/javascript"></script>
        <script src="../../../../vendor/jquery-validation-1.19.1/dist/additional-methods.js" type="text/javascript"></script>
        <script src="../../../../vendor/bootstrap-notify-master/bootstrap-notify.js" type="text/javascript"></script>
        <script src="../js/taxvalidar.js" type="text/javascript"></script>
    </head>
    <body>
        <header class="container">
            <?php
            session_start();
            if($_SESSION["userprof"][0]== 1){
                require_once '../menucajero.php';
            }else if($_SESSION["userprof"][0]==2){
                require_once '../menucabecera.php';
            }
            ?>
        </header>
        <section class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Impuestos</a></li>
                    <li class="breadcrumb-item"><a href="taxadmin.php">Administrar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edición de impuesto</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    Formulario Actualización de Impuestos
                </div>
                <div class="card-body">
                    <form name="miFormulario" id="miFormulario" method="post" action="../../controller/taxcontroller_editarpost.php">
                        <input type="hidden" id="cajaCod" name="cajaCod" value="<?php echo $taxObj->get_idTax() ?>"/>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nombre del impuesto</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="cajaNombre" name="cajaNombre" value="<?php echo $taxObj->get_taxName() ?>"/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Actualizar impuesto</button>
                                <a href="tipoadm.php" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>

        </section>
        <footer>
            <?php
            echo notifications::show($msg, "bottom", "center");
            ?>
        </footer>
    </body>
</html>


