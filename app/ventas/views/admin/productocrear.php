<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");

use app\ventas\controller\proveedorcontroller;
use app\ventas\controller\empresacontroller;
use app\ventas\controller\tipocontroller;
use vendor\messages\notifications;
use vendor\form\dropdown;

$provObj = new proveedorcontroller();
$todosProve = $provObj->getAllDropDown();

$empObj = new empresacontroller();
$todosEmp = $empObj->getAllDropDown();

$tipoProdObj = new tipocontroller();
$todosTip = $tipoProdObj->getAllDropDown();
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
                    <li class="breadcrumb-item active" aria-current="page">Crear</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    Formulario creación de producto
                </div>
                <div class="card-body">
                    <form name="miFormulario" id="miFormulario" method="post" action="../../controller/productocontroller_crearpost.php">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nombre del Producto</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="prodNombre" name="prodNombre" placeholder="Nombre del producto"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Estado del producto</label>
                            <div class="col-sm-4 mb-3">
                                <?php
                                echo DropDown::show("estadoProd", $DOMAINS["ESTADO"], "form-control", "Seleccione el estado del producto", "");
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Proveedores</label>
                            <div class="col-sm-4">
                                <?php
                                echo dropdown::show("cajaPro", $todosProve, "form-control", "Selecciona  un proveedor: ", "");
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Empresa</label>
                            <div class="col-sm-4">
                                <?php
                                echo dropdown::show("cajaEmp", $todosEmp, "form-control", "Selecciona una empresa", "");
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tipo de producto</label>
                            <div class="col-sm-4">
                                <?php
                                echo dropdown::show("cajaTipoP", $todosTip, "form-control", "Selecciona un tipo de producto", "");
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Precio bruto</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="precioBruto" name="precioBruto" placeholder="Precio Bruto del producto"/>
                            </div>
                        </div>  
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Cantidad de producto</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="cantidadProd" name="cantidadProd" placeholder="Cantidad del producto"/>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Crear Producto</button>
                                <a href="taxlistar.php" class="btn btn-secondary">Cancelar</a>
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

