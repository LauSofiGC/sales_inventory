<?php

require_once '../config/loader.php';

use controller\rolcontroller;
use model\role;

$nombreRol = filter_input(INPUT_POST, "cajaNombre");
$codRol = filter_input(INPUT_POST, "cajaCod");

$rolObj = new role();
$controllerType = new rolcontroller();

$rolObj->set_nombreRol($nombreRol);
$rolObj->set_codRol($codRol);


if ($controllerType->updateRol($rolObj)) {
    $msg = 17;
} else {
    $msg = 18;
}
header("location:../public/roleditar.php?cod={$codRol}&msg={$msg}");
?>

