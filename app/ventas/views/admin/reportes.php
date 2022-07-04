<?php
require_once '../../../../config/loader.php';

$msg = filter_input(INPUT_GET, "msg");

use vendor\messages\notifications;
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
                    <li class="breadcrumb-item"><a href="#">Reportes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Generar</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    Generación de reportes
                </div>
                <div class="card-body">
                    <form name="miFormulario" id="miFormulario" method="post" action="../../controller/reportecontroller_crearreporte.php">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tipo de reporte</label>
                            <div class="col-sm-4">
                                <select name="reports" id="reports" class="form-control">
                                    <option value="1" onclick="mostrar(4)">Producto más vendidos</option>
                                    <option value="2" onclick="mostrar(4)">Total de ventas</option>
                                    <option value="3" onclick="mostrar(4)">Devoluciones</option>
                                    <option value="4" onclick="mostrar(5)">Productos agotados</option>
                                    <option value="5" onclick="mostrar(5)">Productos en existencia</option>
                                </select>
                            </div>
                        </div>

                        <div id="f0" class="form-group row">
                            <div class="col-sm-12">
                                <input value="1" type="radio" name="rad" id="rad" onclick="mostrar(1)" /> Diario &nbsp;&nbsp;&nbsp;
                                <input value="2" type="radio" name="rad" id="rad" onclick="mostrar(3)" /> Mensual &nbsp;&nbsp;&nbsp;
                                <input value="3" type="radio" name="rad" id="rad" onclick="mostrar(2)" /> Anual &nbsp;&nbsp;&nbsp;
                                <input value="4" type="radio" name="rad" id="rad" onclick="mostrar(0)" /> Rango de fechas &nbsp;&nbsp;&nbsp;
                            </div>
                        </div>

                        <div id="f1" class="form-group row" style="display:none">
                            <label class="col-sm-2 col-form-label">Fecha Inicio</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="cajaFecIni" name="cajaFecIni"/>
                            </div>
                        </div>
                        <div id="f2" style="display:none" class="form-group row">
                            <label class="col-sm-2 col-form-label">Fecha Fin</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="cajaFecFin" name="cajaFecFin"/>
                            </div>
                        </div>
                        <div id="f3" style="display:none" class="form-group row">
                            <label class="col-sm-2 col-form-label">Año</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="cajaAnio" name="cajaAnio"/>
                            </div>
                        </div>
                        <div id="f4" style="display:none" class="form-group row">
                            <label class="col-sm-2 col-form-label">Mes</label>
                            <div class="col-sm-4">
                                <select name="month" id="month" class="form-control">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Generar Reporte</button>
                                <a href="reportelistar.php" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>

                        <script>
                            function mostrar(num) {
                                if (num == 0) {
                                    document.getElementById('f1').style.display = '';
                                    document.getElementById('f2').style.display = '';
                                    document.getElementById('f3').style.display = 'none';
                                    document.getElementById('f4').style.display = 'none';
                                } else if (num == 1) {
                                    document.getElementById('f1').style.display = 'none';
                                    document.getElementById('f2').style.display = 'none';
                                    document.getElementById('f3').style.display = 'none';
                                    document.getElementById('f4').style.display = 'none';
                                } else if (num == 2) {
                                    document.getElementById('f1').style.display = 'none';
                                    document.getElementById('f2').style.display = 'none';
                                    document.getElementById('f3').style.display = '';
                                    document.getElementById('f4').style.display = 'none';
                                }else if(num == 3){
                                    document.getElementById('f1').style.display = 'none';
                                    document.getElementById('f2').style.display = 'none';
                                    document.getElementById('f3').style.display = 'none';
                                    document.getElementById('f4').style.display = '';
                                }else if(num == 4){
                                    document.getElementById('f0').style.display = '';
                                }else if(num == 5){
                                    document.getElementById('f0').style.display = 'none';
                                }
                            }
                        </script>
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


