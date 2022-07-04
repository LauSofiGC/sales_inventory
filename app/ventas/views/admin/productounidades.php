<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");

use app\ventas\model\product;
use app\ventas\controller\productocontroller;
use vendor\messages\notifications;

$codProdActual = filter_input(INPUT_GET, "cod");

$objProducto = new product();
$controllerObj = new productocontroller();

$objProducto->set_idProduct($codProdActual);
$objProducto = $controllerObj->getOne($objProducto);

//print_r($objProducto);
//exit();
//$nameProd = $objProducto->get_nameProduct();
?>
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
        <script src="../js/productovalidar.js" type="text/javascript"></script>
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
                    <li class="breadcrumb-item"><a href="#">Producto</a></li>
                    <li class="breadcrumb-item"><a href="productoadm.php">Administrar productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Añadir unidades</li>
                </ol>
            </nav>
            <h4>Producto: 
                <span class="badge badge-pill badge-primary">
                    <?php
                    echo $objProducto->get_nameProduct();
                    ?>
                </span>
            </h4>
            <div class="card">
                <div class="card-header">
                    Añadir unidades 
                </div>
                <div class="card-body">
                    <form name="miFormulario" id="miFormulario" method="post" action="../../controller/productcontroller_añadirprod.php">
                        <input type="hidden" id="cajaCodigo" name="cajaCodigo" value="<?php echo $objProducto->get_idProduct() ?>"/>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Cantidad de producto a agregar</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="cantidadProd" name="cantidadProd" placeholder="Cantidad del producto"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Precio producto</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="precioBruto" name="precioBruto" placeholder="Precio Bruto del producto"/>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Agregar productos</button>
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
