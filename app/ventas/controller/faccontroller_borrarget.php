<?php
require_once '../../../config/loader.php';

use app\ventas\model\prodtype;
use app\ventas\controller\tipocontroller;

$codTipo = filter_input(INPUT_GET, "cod");

$tipoObj = new prodtype();
$tipoObj->set_idproductType($codTipo);

$controllerType = new tipocontroller();

if ($controllerType->deleteType($tipoObj)) {
     $msg = 3;
} else {
   $msg = 4;
}
header("location:../views/admin/tipoadm.php?msg={$msg}");
?>