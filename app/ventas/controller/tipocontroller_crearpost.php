<?php
require_once '../../../config/loader.php';

use app\ventas\controller\tipocontroller;
use app\ventas\model\prodtype;

$nombreTipo = filter_input(INPUT_POST, "cajaNombre");
$tipoObj = new prodtype();
$controllerType = new tipocontroller();

$tipoObj->setNameProductType($nombreTipo);
if ($controllerType->addType($tipoObj)) {
    $msg = 1;
} else {
    $msg = 2;
}
header("location:../views/admin/tipocrear.php?msg={$msg}");
?>
