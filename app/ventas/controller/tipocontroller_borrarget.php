<?php
require_once '../../../config/loader.php';

use app\ventas\model\prodtype;
use app\ventas\controller\tipocontroller;

$codTipo = filter_input(INPUT_GET, "codigo");

$tipoObj = new prodtype();
$tipoObj->setIdproductType($codTipo);

$controllerType = new tipocontroller();

if ($controllerType->deleteType($tipoObj)) {
     $msg = 3;
} else {
   $msg = 4;
}
header("location:/sales/app/ventas/views/admin/tipoadm.php?msg={$msg}");
?>