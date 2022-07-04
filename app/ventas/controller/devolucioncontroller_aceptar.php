<?php 
require_once '../../../config/loader.php';

use app\ventas\controller\devolucioncontroller;

$codDev = filter_input(INPUT_GET, "cod");

$devController = new devolucioncontroller();
$codProd = $devController->getIdProd($codDev);

if($devController->acepRechDevolucion($codDev, 1)){
    if($devController->devolverArticulo($codProd)){
    $msg = 33;
    }else{
    $msg = 32;  
    }
}else{
    $msg = 32;
}

header("location:/sales/app/ventas/views/admin/devolucionaprobada.php?msg={$msg}");
?>