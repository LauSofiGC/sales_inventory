<?php 
require_once '../../../config/loader.php';

use app\ventas\repos\devolucionrepo;

$idBuscar = filter_input(INPUT_POST, "idProd");
$repoDev = new devolucionrepo();

if($repoDev->verificarExiste($idBuscar)==1){
    $msg = 24;
    header("location:../views/admin/elegirdevolucion.php?cod={$idBuscar}&msg={$msg}");
}else{
    $msg = 25;
    header("location:../views/creardevolucion.php?msg={$msg}");
}
?>

