<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");

use app\ventas\controller\productocontroller;
use vendor\messages\notifications;

$objeto = new productocontroller();
$filas = $objeto->getAllProd();

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
                    <li class="breadcrumb-item"><a href="#">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Administrar</li>
                </ol>
            </nav>
            <table class="table table-sm table-striped table-bordered">
                 <thead class="thead-light table-striped" >
                        <tr>
                            <th style="width:5% ">C??digo</th>
                            <th style="width:20%">Nombre</th>
                            <th style="width:15%">Proveedor</th>
                            <th style="width:23%">Tipo de producto</th>
                            <th style="width:10%">Precio Bruto</th>
                            <th style="width:10%">Cantidad</th>
                            <th style="width: 7%">&nbsp;</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php
                    foreach ($filas as $indice => $columnas) {
                        $codigo = $columnas["idPRODUCT"];
                        $precioFormateado = number_format($columnas["precioBruto"]);
                        echo "<tr>";
                        echo "<td>{$columnas["idPRODUCT"]}</td>";
                        echo "<td>{$columnas["nameProduct"]}</td>";
                        echo "<td>{$columnas["provName"]}</td>";
                        echo "<td>{$columnas["prodTyName"]}</td>";
                        echo "<td>$ {$precioFormateado}</td>";
                        echo "<td>{$columnas["quantity"]}</td>";
                        echo "<td class=\"text-center\">";
                        echo "<a title=\"Editar producto\" href=\"productoeditar.php?cod={$codigo}\">";
                        echo "<i class=\"far fa-edit edit\"></i>";
                        echo "</a>";
                        echo "&nbsp; &nbsp;";
                        echo "<a title=\"A??adir impuesto\" href=\"prodimpcrear.php?cod={$codigo}\">";
                        echo "<i class=\"fas fa-dollar-sign\"></i>";
                        echo "</a>";
                        echo "&nbsp; &nbsp;";
                        echo "<a title=\"A??adir unidades\" href=\"productounidades.php?cod={$codigo}\">";
                        echo "<i class=\"far fa-plus-square\"></i>";
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
    </body>
</html>