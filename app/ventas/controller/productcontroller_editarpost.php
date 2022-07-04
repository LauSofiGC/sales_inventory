<?php
require_once '../../../config/loader.php';

use app\ventas\controller\productocontroller;
use app\ventas\model\product;

$cod = filter_input(INPUT_POST, "cajaCod");
$nombreTipo = filter_input(INPUT_POST, "cajaNom");
$estado = filter_input(INPUT_POST, "cajaEst");
$prov = filter_input(INPUT_POST, "cajaProv");
$ent = filter_input(INPUT_POST, "cajaEnt");
$prodT = filter_input(INPUT_POST, "cajaprodT");
$preB = filter_input(INPUT_POST, "cajapreB");

$prodObj = new product();
$controllerProd = new productocontroller();

$prodObj->set_idProduct($cod);
$prodObj->set_nameProduct($nombreTipo);
$prodObj->set_productState($estado);
$prodObj->set_idProvider($prov);
$prodObj->set_idEnterprise($ent);
$prodObj->set_idProductType($prodT);
$prodObj->set_precioBruto($preB);

if ($controllerProd->updateProd($prodObj)) {
    $msg = 17;
} else {
    $msg = 18;
}
header("location:../views/admin/productoeditar.php?cod={$cod}&msg={$msg}");

?>