<?php
require_once '../config/loader.php';

use controller\rolcontroller;
use model\role;

$nombreRol = filter_input(INPUT_POST, "cajaNombre");
$rolObj = new role();
$controllerRol = new rolcontroller();

$rolObj->set_nombreRol($nombreRol);
if ($controllerRol->addRol($rolObj)) {
    $msg = 13;
} else {
    $msg = 14;
}
header("location:../public/rolcrear.php?msg={$msg}");
?>

