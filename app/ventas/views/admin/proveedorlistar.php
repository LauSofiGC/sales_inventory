<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");

use app\ventas\controller\proveedorcontroller;

$objeto = new proveedorcontroller();
$filas = $objeto->getAll();
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
                    <li class="breadcrumb-item"><a href="#">Proveedores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar</li>
                </ol>
            </nav>
            <table class="table table-sm table-striped table-bordered mt-4">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 10%">Código</th>
                        <th style="width: 60%">Nombre del proveedor</th>
                        <th style="width: 30%">Teléfono del proveedor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($filas as $indice => $columnas) {
                        echo "<tr>";
                        echo "<td>{$columnas["idProvider"]}</td>";
                        echo "<td>{$columnas["providerName"]}</td>";
                        echo "<td>{$columnas["phoneNumber"]}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        </section>
    </body>
</html>
