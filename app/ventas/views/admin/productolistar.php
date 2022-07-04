<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");

use app\ventas\controller\productocontroller;

$objeto = new productocontroller();
$filas = $objeto->getAllProd();
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
                    <li class="breadcrumb-item"><a href="#">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar</li>
                </ol>
            </nav>
            <table class="table table-sm table-striped table-bordered mt-4">
                 <thead class="thead-light table-striped" >
                        <tr>
                            <th style="width:5% ">Código</th>
                            <th style="width:20%">Nombre</th>
                            <th style="width:20%">Proveedor</th>
                            <th style="width:25%">Tipo de producto</th>
                            <th style="width:10%">Precio Bruto</th>
                            <th style="width:10%">Cantidad</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php
                    foreach ($filas as $indice => $columnas) {
                        $precioFormateado = number_format($columnas["precioBruto"]);
                        echo "<tr>";
                        echo "<td>{$columnas["idPRODUCT"]}</td>";
                        echo "<td>{$columnas["nameProduct"]}</td>";
                        echo "<td>{$columnas["provName"]}</td>";
                        echo "<td>{$columnas["prodTyName"]}</td>";
                        echo "<td>$ {$precioFormateado}</td>";
                        echo "<td>{$columnas["quantity"]}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        </section>
    </body>
</html>
