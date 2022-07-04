<?php

require_once '../../../config/loader.php';

use app\ventas\controller\devolucioncontroller;
use app\ventas\repos\devolucionrepo;

$devRepo = new devolucionrepo();

$devDate = $devRepo->devDate();
$codTi = filter_input(INPUT_POST, "cajaCod");

$arregloTickTaxProd = filter_input(INPUT_POST, "idTicket_TAX_PRODUCT", FILTER_DEFAULT, FILTER_FORCE_ARRAY);

$msg = 30;
if (!empty($arregloTickTaxProd)) {
    $objController = new devolucioncontroller();
    foreach ($arregloTickTaxProd as $index => $codTicketTaxProd) {
        if ($objController->verifyDateDev($codTicketTaxProd, $devDate)) {
            if ($objController->addDevolution($codTicketTaxProd, $devDate)){
                $msg = 31;
            }else{
                $msg;
            }
        }else{
            $msg;
        }
    }
}

header("location:../views/devoluciondetalle.php?cod={$codTi}&msg={$msg}");
?>
