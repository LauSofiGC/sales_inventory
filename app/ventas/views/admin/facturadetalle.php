<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");
$codFac = filter_input(INPUT_GET, "cod");

use app\ventas\controller\tickettaxproductcontroller;
use app\ventas\controller\productocontroller;
use app\ventas\controller\ticketcontroller;
use vendor\messages\notifications;

$objeto = new tickettaxproductcontroller();
$prodCon = new productocontroller();
$tickCo = new ticketcontroller();
$filas = $objeto->getFacturaDetalle($codFac);
$precioTot = $prodCon->getTotalprice($codFac);
$impTot = $prodCon->getImpuestoTot($codFac);
$subtotal = $prodCon->getPrecioBrutoTotal($codFac);
$tickCo->actualizarFac($codFac, $precioTot, $subtotal, $impTot);
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
        <script src="../js/facturaprodborrar.js" type="text/javascript"></script>
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
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Tickets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Factura detalle</li>
                </ol>
            </nav>
            <table class="table table-sm table-striped table-bordered mt-4">
                <thead class="thead-light table-striped" >
                    <tr>
                        <th style="width:25%">Fecha de devolución de producto máxima</th>
                        <th style="width:45%">Nombre del producto</th>
                        <th style="width:25%">Precio del producto</th>
                        <th style="width: 5%">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($filas as $indice => $columnas) {
                        $codigo = $columnas["idTicket_TAX_PRODUCT"];
                        $nombre = $columnas["prodNam"];
                        $precioFormateado = number_format($columnas["precioProd"]);
                        $iconoBorrar = "<a title=\"Borrar Producto\" "
                                . "style=\"cursor: pointer\" "
                                . "data-toggle=\"modal\" "
                                . "data-target=\"#ventanaBorrar\" "
                                . "data-code=\"{$codigo}\" "
                                . "data-message=\"{$nombre}\"> "
                                . "<i class=\"far fa-trash-alt trashRed\"></i> "
                                . "</a>";
                        echo "<tr>";
                        echo "<td>{$columnas["dateTicketTaxProductDevolution"]}</td>";
                        echo "<td>{$columnas["prodNam"]}</td>";
                        echo "<td>$ {$precioFormateado}</td>";
                        echo "<td>{$iconoBorrar}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <h4>Subtotal: 
                <span class="badge badge-pill badge-primary">
                    <?php
                    $precioForm = number_format($subtotal);
                    echo "$ " . $precioForm;
                    ?>
                </span>
            </h4>
            <h4>Impuestos:
                <span class="badge badge-pill badge-primary">
                    <?php
                    $precioFormateado = number_format($impTot);
                    echo "$ " . $precioFormateado;
                    ?>
                </span>
            </h4>
            <h4>Precio total: 
                <span class="badge badge-pill badge-primary">
                    <?php
                    $precioTotFormateado = number_format($precioTot);
                    echo "$ " . $precioTotFormateado;
                    ?>
                </span>
            </h4>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="ventanaBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Advertencia!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        xxx
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <a id="enlaceBorrar" href="#" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <?php
            echo notifications::show($msg, "bottom", "center");
            ?>
        </footer>
    </body>
</html>
