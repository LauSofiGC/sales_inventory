<?php
require_once '../../../config/loader.php';

use app\ventas\controller\ventascontroller;
use app\ventas\controller\prodimpcontroller;
use app\ventas\controller\tipocontroller;
use vendor\form\dropdown;

$msg = filter_input(INPUT_GET, "msg");
$codTick = filter_input(INPUT_GET, "cod");

$objVentasCont = new ventascontroller();
$objProdCont = new prodimpcontroller();
$tipoProdObj = new tipocontroller();

$filas = $objProdCont->getAll();
$numRecord = $objProdCont->getNumRecords();
$todosTip = $tipoProdObj->getAllDropDown();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../../../vendor/tws/bootstrap-4.4.1/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../../../vendor/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet" type="text/css"/>
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>

        <script src="../../..   /public/js/jquery-3.4.1.js" type="text/javascript"></script>
        <script src="../../../vendor/fontawesome-free-5.15.3-web/js/all.js" type="text/javascript"></script>
        <script src="../../../vendor/tws/bootstrap-4.4.1/dist/js/bootstrap.js" type="text/javascript"></script>
        <script src="../../../vendor/jquery-validation-1.19.1/dist/jquery.validate.js" type="text/javascript"></script>
        <script src="../../../vendor/jquery-validation-1.19.1/dist/additional-methods.js" type="text/javascript"></script>
        <script src="../../../vendor/bootstrap-notify-master/bootstrap-notify.js" type="text/javascript"></script>
        <script src="js/ventas.js" type="text/javascript"></script>
    </head>
    <body>
        <header class="container">
            <?php
            session_start();
            if ($_SESSION["userprof"][0] == 1) {
                require_once 'menucajero.php';
            } else if ($_SESSION["userprof"][0] == 2) {
                require_once 'menucabecera.php';
            }
            ?>
        </header>
        <section class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Ventas</a></li>
                </ol>
            </nav>
            <form id="buscar_prod" name="buscar_prod" method="get" action="../controller/buscar_prod.php">
                <input id="inNomProd" name="inNomProd" type="text" class="form-control" placeholder="Buscar" />
                <button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
            </form>
            <form id="frm" name="frm" method="post" action="../controller/ventascontroller_addProdTick.php">
                <table class="table table-sm table-striped table-bordered mt-4">
                    <thead class="thead-light table-striped" >
                        <tr>
                            <th style="width:5% ">Id</th>
                            <th style="width:30%">Producto</th>
                            <th style="width:20%">                                
                                <?php
                                echo dropdown::show("buscar_tipo_prod", $todosTip, "form-control", "Tipo de producto", "");
                                ?></th>
                            <th style="width:20%">Impuesto</th>
                            <th style="width:15%">Precio</th> 
                            <th style="width:5%">Cantidad</th> 
                            <th style="width:5%">Añadir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $incremento = 1;
                        if ($numRecord > 0) {
                            foreach ($filas as $indice => $columnas) {
                                $codEst = $columnas["idTAX_PRODUCT"];
                                $cantidadMax = $columnas["quan"];
                                $precioFormateado = number_format($columnas["precio"]);
                                $checkBox = "<div class=\"custom-control custom-checkbox\">";
                                $checkBox .= "<input class=\"custom-control-input\" type=\"checkbox\" name=\"idTAX_PRODUCT[]\" id=\"idTAX_PRODUCT{$incremento}\" value=\"{$codEst}\"/>";
                                $checkBox .= "<label class=\"custom-control-label\" for=\"idTAX_PRODUCT{$incremento}\"></label>";
                                $checkBox .= "</div>";
                                $cant = "<div class=\"custom-control\">";
                                $cant .= "<input type=\"number\" min=\"1\" max=\"{$cantidadMax}\" name=\"cantidad[]\" id=\"cantidad{$incremento}\" style=\"width : 100px;\"/>";
                                $cant .= "</div>";
                                $incremento++;
                                echo "<tr>";
                                echo "<td>{$columnas["idTAX_PRODUCT"]}</td>";
                                echo "<td>{$columnas["nomProd"]}</td>";
                                echo "<td>{$columnas["prodType"]}</td>";
                                echo "<td>{$columnas["nomTax"]}</td>";
                                echo "<td>$ {$precioFormateado}</td>";
                                echo "<td>$cant</td>";
                                echo "<td>$checkBox</td>";
                                echo "</tr>";
                            }
                        } else {
                            ?> 
                        <div class="alert alert-danger"> 
                            No hay productos disponibles.
                        </div>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="../controller/ventascontroller_cancelarticket.php" class="btn btn-primary">Cancelar compra</a>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success float-right">Agregar productos a ticket</button>
                    </div>
                </div>
            </form>
        </section>
    </body>
</html>

