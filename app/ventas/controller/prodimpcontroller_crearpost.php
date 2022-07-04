<?php
require_once '../../../config/loader.php';

use app\ventas\controller\prodimpcontroller;
use app\ventas\model\taxproduct;

//echo "<pre>";
//print_r($_POST);
//echo "<pre/>";

$fec = filter_input(INPUT_POST, 'fechaImp');
$prod =  filter_input(INPUT_POST, "cajaCod");
$imp = filter_input(INPUT_POST, 'cajaImp');

$proObj = new taxproduct();
$controllerProd = new prodimpcontroller();

$proObj->set_dateInit($fec);
$proObj->set_idProduct($prod);
$proObj->set_idTax($imp);

if ($controllerProd->addPerson($proObj)) {
    $msg = 22;
} else {
    $msg = 23;
}
header("location:../views/admin/prodimpcrear.php?cod={$prod}&msg={$msg}");
?>

