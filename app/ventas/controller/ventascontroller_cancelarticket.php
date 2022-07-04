<?php

require_once '../../../config/loader.php';
use app\ventas\controller\ticketcontroller;

$tiRepo = new ticketcontroller();

$idTicket = $tiRepo->verificarUltId();

if ($tiRepo->eliminarTicket($idTicket)) {
    $msg = 35;
} else {
    $msg = 34;
}

header("location:../views/crearticket.php?msg={$msg}");
?>
