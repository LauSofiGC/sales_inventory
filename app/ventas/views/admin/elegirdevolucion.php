<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");
$codFac = filter_input(INPUT_GET, "cod");

use app\ventas\controller\tickettaxproductcontroller;
use app\ventas\controller\productocontroller;
use vendor\messages\notifications;

$objeto = new tickettaxproductcontroller();
$prodCon = new productocontroller();
$filas = $objeto->getFilteredFacturaDetalle($codFac);
$cantidadRegistros = count($filas);

use app\ventas\model\ticket;

$tick = new ticket();
$tick->set_idTicket($codFac);
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
                    <li class="breadcrumb-item"><a href="#">Devoluciones</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Factura detalle</li>
                </ol>
            </nav>
            <?php
            if ($cantidadRegistros > 0) {
                ?>
                <form id="frm" name="frm" method="post" action="../../controller/devolucioncontroller_addDev.php">
                    <input type="hidden" id="cajaCod" name="cajaCod" value="<?php echo $tick->get_idTicket() ?>"/>
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
                            $incremento = 1;
                            foreach ($filas as $indice => $columnas) {
                                $codigo = $columnas["idTicket_TAX_PRODUCT"];
                                $nombre = $columnas["prodNam"];
                                $precioFormateado = number_format($columnas["precioProd"]);
                                $checkBox = "<div class=\"custom-control custom-checkbox\">";
                                $checkBox .= "<input class=\"custom-control-input\" type=\"checkbox\" name=\"idTicket_TAX_PRODUCT[]\" id=\"idTicket_TAX_PRODUCT{$incremento}\" value=\"{$codigo}\"/>";
                                $checkBox .= "<label class=\"custom-control-label\" for=\"idTicket_TAX_PRODUCT{$incremento}\"></label>";
                                $checkBox .= "</div>";
                                $incremento++;
                                echo "<tr>";
                                echo "<td>{$columnas["dateTicketTaxProductDevolution"]}</td>";
                                echo "<td>{$columnas["prodNam"]}</td>";
                                echo "<td>$ {$precioFormateado}</td>";
                                echo "<td> $checkBox </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary float-right">Pedir devolución</button>
                        </div>                
                    </div>
                </form>
                <?php
            } else {
                ?> 
                <div class="alert alert-warning"> 
                    No se pueden realizar devoluciones para este Ticket
                </div>
                <?php
            }
            ?>
        </section>
        <footer>
            <?php
            echo notifications::show($msg, "bottom", "center");
            ?>
        </footer>
    </body>
</html>
