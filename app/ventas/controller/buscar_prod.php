<?php

require_once '../../../config/loader.php';

use app\ventas\controller\ventascontroller;

$busqueda = filter_input(INPUT_POST, "inNomProd");
$tipoProd = filter_input(INPUT_POST, "buscar_tipo_prod");
$ventaController = new ventascontroller();

if ($busqueda == null && $tipoProd == null) {
    header("location:../views/ventas.php");
} if ($busqueda != null) {
    
}
?>