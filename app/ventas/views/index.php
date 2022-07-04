<?php
require_once '../../../config/loader.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <link href="../../../vendor/tws/bootstrap-4.4.1/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../../../vendor/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet" type="text/css"/>
        <link href="css/css.css" rel="stylesheet" type="text/css"/>
        
        <script src="../../../public/js/jquery-3.4.1.js" type="text/javascript"></script>
        <script src="../../../vendor/tws/bootstrap-4.4.1/dist/js/bootstrap.js" type="text/javascript"></script>

    </head>
    <body>
        <header class="container">
            <?php
            session_start();
            if($_SESSION["userprof"][0]== 1){
                require_once './menucajero.php';
            }else if($_SESSION["userprof"][0]==2){
                require_once './menucabecera.php';
            }
            ?>
        </header>

        <div class="imagen">
            <div class="card w-50 mt-4" style="width: 18rem; margin: 0 auto;" >
                <img class="card-img-top" src="img/cajero.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-text" style="text-align: center">Sistema de ventas y devoluciones</h4>
                </div>
            </div>
        </div>
    </body>
</html>

