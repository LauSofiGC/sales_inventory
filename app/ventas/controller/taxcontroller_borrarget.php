<?php
require_once '../../../config/loader.php';

use app\ventas\model\tax;
use app\ventas\controller\taxcontroller;

$codTax = filter_input(INPUT_GET, "codigo");

$taxObj = new tax();
$taxObj->set_idTax($codTax);

$controllerTax = new taxcontroller();

if ($controllerTax->deleteTax($taxObj)) {
   $msg = 9;
} else {
   $msg = 10;
}
header("location:../views/admin/taxadmin.php?msg={$msg}");
?>
