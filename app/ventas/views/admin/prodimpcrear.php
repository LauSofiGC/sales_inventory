<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");

use app\ventas\controller\prodimpcontroller;
use app\ventas\model\product;
use app\ventas\controller\taxcontroller;
use app\ventas\controller\productocontroller;
use vendor\messages\notifications;
use vendor\form\dropdown;

$codProd = filter_input(INPUT_GET, "cod");

$rolObj = new prodimpcontroller();
$controllerObj = new productocontroller();
$prodObj = new product();
$taxObj = new taxcontroller();

$prodObj->set_idProduct($codProd);
$prodObj = $controllerObj->getOne($prodObj);
$todosTax = $taxObj->getFiltered($codProd);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../../../../vendor/tws/bootstrap-4.4.1/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../../../../vendor/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet" type="text/css"/>
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>

        <script src="../../../../public/js/jquery-3.4.1.js" type="text/javascript"></script>
        <script src="../../../../vendor/fontawesome-free-5.15.3-web/js/all.js" type="text/javascript"></script>
        <script src="../../../../vendor/tws/bootstrap-4.4.1/dist/js/bootstrap.js" type="text/javascript"></script>
        <script src="../../../../vendor/jquery-validation-1.19.1/dist/jquery.validate.js" type="text/javascript"></script>
        <script src="../../../../vendor/jquery-validation-1.19.1/dist/additional-methods.js" type="text/javascript"></script>
        <script src="../../../../vendor/bootstrap-notify-master/bootstrap-notify.js" type="text/javascript"></script>
        <script src="../js/proveedorvalidar.js" type="text/javascript"></script>
    </head>
    <body>
        <header class="container">
            <?php
            session_start();
            if ($_SESSION["userprof"][0] == 1) {
                require_once '../menucajero.php';
            } else if ($_SESSION["userprof"][0] == 2) {
                require_once '../menucabecera.php';
            }
            ?>
        </header>
        <section class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="Index.php"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="productoadm.php">Administrar productos</a></li>
                    <li class="breadcrumb-item"><a href="#">Asignar impuesto</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Crear</li>
                </ol>
            </nav>
            <h4>Producto: 
                <span class="badge badge-pill badge-primary">
                    <?php
                    echo $prodObj->get_nameProduct();
                    ?>
                </span>
            </h4>
            <div class="card">
                <div class="card-header">
                    Formulario asignación de impuesto
                </div>
                <div class="card-body">
                    <form name="miFormulario" id="miFormulario" method="post" action="../../controller/prodimpcontroller_crearpost.php">
                        <input type="hidden" id="cajaCod" name="cajaCod" value="<?php echo $prodObj->get_idProduct() ?>"/>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fecha inicio impuesto </label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="fechaImp" name="fechaImp"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Impuesto</label>
                            <div class="col-sm-4">
                                <?php
                                echo dropdown::show("cajaImp", $todosTax, "form-control", "Selecciona  un impuesto: ", "");
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Asignar impuesto</button>
                                <a href="productoadm.php" class="btn btn-secondary">Cancelar</a>
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