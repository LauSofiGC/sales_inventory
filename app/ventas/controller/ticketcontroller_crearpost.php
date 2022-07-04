<?php
require_once '../../../config/loader.php';

use app\ventas\controller\ticketcontroller;
use app\ventas\model\ticket;

$fecha = filter_input(INPUT_POST, "fecha");
$cli = filter_input(INPUT_POST, "cajaClie");

$ticObj = new ticket();
$ticController = new ticketcontroller();

$ticObj->set_ticketDate($fecha);
$ticObj->set_idPerson($cli);

if($ticController->addTicket($ticObj)){
    $msg = 40;
}else{
    $msg = 41;
}
header("location:../views/ventas.php?msg={$msg}");
?>

