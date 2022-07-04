<?php

require_once '../../../config/loader.php';

use app\ventas\controller\ticketcontroller;

$tiRepo = new ticketcontroller();
$numFac = $tiRepo->verificarUltId();
$devDate = $tiRepo->devDate($numFac);

//echo "<pre>";
//print_r($devDate);
//echo "<pre/>";
//exit();

$arregloTickTax = filter_input(INPUT_POST, "idTAX_PRODUCT", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$arregloCantidades = filter_input(INPUT_POST, "cantidad", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$filterCantidades = array_filter($arregloCantidades);

//
//echo "<pre>";
//print_r($filterCantidades);
//echo "<pre/>";
//exit();

use app\ventas\controller\ventascontroller;

$msg = 27;
//if (!empty($arregloTickTax)) {
//    $objController = new ventascontroller();
//    foreach ($arregloTickTax as $index => $codTicketTax) {
//        if ($objController->addProductTicket($codTicketTax, $numFac, $devDate)& $objController->resProduct($codTicketTax)) {
//            $msg = 26;
//        }
//    }
//}
//if (!empty($arregloTickTax)) {
//    $objController = new ventascontroller();
//    $flag = 1;
//    foreach ($arregloTickTax as $index => $codTicketTax) {
//        for ($i = 1; $i <= $filterCantidades[flag]; $i++) {
//            if ($objController->addProductTicket($codTicketTax, $numFac, $devDate) & $objController->resProduct($codTicketTax)) {
//                $msg = 26;
//                $flag++;
//            } else {
//                $msg = 27;
//            }
//        }
//    }
//}

if (!empty($arregloTickTax)) {
    $objController = new ventascontroller();
    $flag = 0;
    foreach ($filterCantidades as $index => $cantidades) {
        $codProd = $objController->getIdProd($arregloTickTax[$flag]);
        for ($i = 0; $i < $cantidades; $i++) {
            if ($objController->addProductTicket($arregloTickTax[$flag], $numFac, $devDate) & $objController->resProduct($codProd)) {
                $msg = 26;
            } else {
                $msg = 27;
            }
        }
        $flag++;
    }
}

header("location:../views/admin/facturadetalle.php?cod={$numFac}&msg={$msg}");
?>