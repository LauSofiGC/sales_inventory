<?php
require_once '../../../config/loader.php';

use app\ventas\controller\taxcontroller;
use app\ventas\model\tax;

$nombreTax = filter_input(INPUT_POST, "cajaNombre");
$val = filter_input(INPUT_POST, "cajaVal");
$taxObj = new tax();
$controllerTax = new taxcontroller();

$taxObj->set_taxName($nombreTax);
$taxObj->set_value($val);
if ($controllerTax->addTax($taxObj)) {
    $msg = 7;
} else {
    $msg = 8;
}
header("location:../views/admin/taxcrear.php?msg={$msg}");
?>

