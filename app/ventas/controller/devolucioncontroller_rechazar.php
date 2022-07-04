<?php 
require_once '../../../config/loader.php';

use app\ventas\controller\devolucioncontroller;

$codDev = filter_input(INPUT_GET, "cod");

$devController = new devolucioncontroller();

if($devController->acepRechDevolucion($codDev, 2)){
    $msg = 33;
}else{
    $msg = 32;
}

header("location:/sales/app/ventas/views/admin/devolucionrechazada.php?msg={$msg}");
?>