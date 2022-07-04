<?php

require_once '../../../config/loader.php';

use app\ventas\controller\productocontroller;

$cod = filter_input(INPUT_POST, "cajaCodigo");
$cantidad = filter_input(INPUT_POST, "cantidadProd");
$precio = filter_input(INPUT_POST, "precioBruto");

$controllerProd = new productocontroller();
//$arregloProdTax = $controllerProd->getTaxProd($cod);

if ($controllerProd->updateQuan($cod, $cantidad, $precio)) {
  //  if (!empty($arregloProdTax)) {
    //    foreach ($arregloProdTax as $index => $codTicketTax) {
    if($controllerProd->updateTotalPrice($cod) && $controllerProd->updateTaxValue($cod)){
            $msg = 29;
    }else{
        $msg = 28;
    }
     //   }
    } else {
        $msg = 28;
    }
//}
header("location:../views/admin/productounidades.php?cod={$cod}&msg={$msg}");
?>
