<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");

use app\ventas\controller\tipocontroller;
use vendor\messages\notifications;

$objeto = new tipocontroller();
$filas = $objeto->getAllTipo();

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
        <script src="../js/tipoborrar.js" type="text/javascript"></script>
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
                    <li class="breadcrumb-item"><a href="#">Tipo de producto</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Administrar</li>
                </ol>
            </nav>
            <table class="table table-sm table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 12%">Código</th>
                        <th style="width: 64%">Nombre Tipo de producto</th>
                        <th style="width:15%" class="text-center">Cant. Productos</th>
                        <th style="width: 9%">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($filas as $indice => $columnas) {
                        $codigo = $columnas["idproductType"];
                        $nombre = $columnas["nameProductType"];
                        $cantidad = $columnas["cantidad"];

                        $cantidadProductos = $columnas["cantidad"];
                        if ($cantidadProductos == 0) {
                            $iconoBorrar = "<a title=\"Borrar Tipo de Producto\" "
                                    . "style=\"cursor: pointer\" "
                                    . "data-toggle=\"modal\" "
                                    . "data-target=\"#ventanaBorrar\" "
                                    . "data-code=\"{$codigo}\" "
                                    . "data-message=\"{$nombre}\"> "
                                    . "<i class=\"far fa-trash-alt trashRed\"></i> "
                                    . "</a>";
                        } else {
                            $iconoBorrar = "<i class=\"far fa-trash-alt trashGray\"></i> ";
                        }
                        echo "<tr>";

                        echo "<td>{$codigo}</td>";
                        echo "<td>{$nombre}</td>";
                        echo "<td class=\"text-center\">{$cantidad}</td>";

                        echo "<td class=\"text-center\">";
                        echo "{$iconoBorrar}&nbsp;";
                        echo "<a title=\"Editar división\" href=\"tipoeditar.php?cod={$codigo}\">";
                        echo "<i class=\"far fa-edit edit\"></i>";
                        echo "</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        </section>
        <footer>
            <?php
            echo notifications::show($msg, "bottom", "center");
            ?>
        </footer>
        <!-- Button trigger modal -->


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
    </body>
</html>
