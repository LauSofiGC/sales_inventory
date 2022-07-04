<?php

require_once '../../../config/loader.php';

use app\ventas\controller\taxcontroller;
use app\ventas\model\tax;

$nombreTax = filter_input(INPUT_POST, "cajaNombre");
$codTax = filter_input(INPUT_POST, "cajaCod");

$taxObj = new tax();
$controllerType = new taxcontroller();

$taxObj->set_taxName($nombreTax);
$taxObj->set_idTax($codTax);


if ($controllerType->updateTax($taxObj)) {
    $msg = 11;
} else {
    $msg = 12;
}
header("location:../views/admin/taxeditar.php?cod={$codTax}&msg={$msg}");
?>

