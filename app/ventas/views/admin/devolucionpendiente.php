<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");

use app\ventas\controller\devolucioncontroller;
use vendor\messages\notifications;

$objeto = new devolucioncontroller();
$filas = $objeto->getDevolucionesPendientes();
$cantidadRegistros = count($filas);
?>
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
        <script src="../js/devolucionaceptar.js" type="text/javascript"></script>
        <script src="../js/devolucionrechazar.js" type="text/javascript"></script>

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
                    <li class="breadcrumb-item active" aria-current="page">Devoluciones pendientes</li>
                </ol>
            </nav>
            <h4>Devoluciones: 
                <span class="badge badge-pill badge-warning">
                    <?php
                    echo "Devoluciones pendientes"
                    ?>
                </span>
            </h4>
            <?php
            if ($cantidadRegistros > 0) {
                ?>
                <table class="table table-sm table-striped table-bordered mt-4">
                    <thead class="thead-light table-striped" >
                        <tr>
                            <th style="width:10%">ID de devolución</th>
                            <th style="width:20%">Fecha de devolución</th>
                            <th style="width:25%">Nombre del producto</th>
                            <th style="width:10%">Subtotal</th>
                            <th style="width:10%">Impuestos</th>
                            <th style="width:15%">Total a devolver</th>
                            <th style="width:10%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($filas as $indice => $columnas) {
                            $codigo = $columnas["idDevolution"];
                            $nombreProd = $columnas["prodname"];
                            $precioFormateado = number_format($columnas["prodprecio"]);
                            $preciImp = number_format($columnas["impuestoprecio"]);
                            $preciBrut = number_format($columnas["precioBruto"]);
                            $iconoAceptarDev = "<a title=\"Aceptar devolución\" "
                                    . "style=\"cursor: pointer\""
                                    . "data-toggle=\"modal\" "
                                    . "data-target=\"#ventanaAceptar\" "
                                    . "data-code=\"{$codigo}\" "
                                    . "data-message=\"{$nombreProd}\"> "
                                    . "<i class=\"far fa-check-circle aceptarDev\"></i>"
                                    . "</a>";
                            $iconoRechazarDev = "<a title=\"Rechazar devolución\" "
                                    . "style=\"cursor: pointer\""
                                    . "data-toggle=\"modal\" "
                                    . "data-target=\"#ventanaRechazar\" "
                                    . "data-code=\"{$codigo}\" "
                                    . "data-message=\"{$nombreProd}\"> "
                                    . "<i class=\"far fa-times-circle rechazarDev\"></i>"
                                    . "</a>";
                            echo "<tr>";
                            echo "<td>{$columnas["idDevolution"]}</td>";
                            echo "<td>{$columnas["dateDevolution"]}</td>";
                            echo "<td>{$columnas["prodname"]}</td>";
                            echo "<td>$ {$preciBrut}</td>";
                            echo "<td>$ {$preciImp}</td>";
                            echo "<td>$ {$precioFormateado}</td>";
                            echo "<td>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            echo $iconoAceptarDev;
                            echo "&nbsp;&nbsp;";
                            echo $iconoRechazarDev;
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                ?> 
                <div class="alert alert-warning"> 
                    No existen devoluciones pendientes
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
        <div class="modal fade" id="ventanaAceptar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        XXX
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger" href="#" id="enlaceAceptar">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ventanaRechazar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        XXX
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger" href="#" id="enlaceRechazar">Rechazar</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
