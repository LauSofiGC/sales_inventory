<?php
require_once '../config/loader.php';

use model\role;
use controller\rolcontroller;

$codRol = filter_input(INPUT_GET, "codigo");

$rolObj = new role();
$rolObj->set_codRol($codRol);

$controllerRol = new rolcontroller();

if ($controllerRol->deleteRol($rolObj)) {
   $msg = 15;
} else {
   $msg = 16;
}
header("location:../public/roladmin.php?msg={$msg}");
?>
