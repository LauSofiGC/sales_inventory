<?php
require_once '../../../config/loader.php';

use app\ventas\controller\productocontroller;
use app\ventas\model\product;

$nombreProd = filter_input(INPUT_POST, 'prodNombre');
$estadoProd = filter_input(INPUT_POST, 'estadoProd');
$prov = filter_input(INPUT_POST, 'cajaPro');
$emp = filter_input(INPUT_POST, 'cajaEmp');
$tipoProd = filter_input(INPUT_POST, 'cajaTipoP');
$prec = filter_input(INPUT_POST, "precioBruto");
$cantPro = filter_input(INPUT_POST, "cantidadProd");

$proObj = new product();
$controllerProd = new productocontroller();

$proObj->set_nameProduct($nombreProd);
$proObj->set_productState($estadoProd);
$proObj->set_idProvider($prov);
$proObj->set_idEnterprise($emp);
$proObj->set_idProductType($tipoProd);
$proObj->set_precioBruto($prec);
$proObj->set_quantity($cantPro);

if ($controllerProd->addProduct($proObj)) {
    $msg = 13;
} else {
    $msg = 14;
}
header("location:../views/admin/productocrear.php?msg={$msg}");
?>

