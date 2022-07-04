<?php

require_once '../../../config/loader.php';

use app\ventas\controller\tipocontroller;
use app\ventas\model\prodtype;

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//exit();

$nombreTipo = filter_input(INPUT_POST, "cajaNombre");
$codTipo = filter_input(INPUT_POST, "cajaCod");

$tipoObj = new prodtype();
$controllerType = new tipocontroller();

$tipoObj->setNameProductType($nombreTipo);
$tipoObj->setIdproductType($codTipo);


if ($controllerType->updateType($tipoObj)) {
    $msg = 5;
} else {
    $msg = 6;
}
header("location:../views/admin/tipoeditar.php?cod={$codTipo}&msg={$msg}");
?>
