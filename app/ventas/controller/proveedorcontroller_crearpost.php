<?php

require_once '../../../config/loader.php';

use app\ventas\controller\proveedorcontroller;
use app\ventas\model\provider;

$nomPro = filter_input(INPUT_POST, "cajaNomPro");
$telPro = filter_input(INPUT_POST, "cajaTelPro");

$personaObj = new provider();
$facadePersona = new proveedorcontroller();

$personaObj->set_phoneNumber($telPro);
$personaObj->set_providerName($nomPro);

if ($facadePersona->addPerson($personaObj)) {
    $msg = 19;
} else {
    $msg = 20;
}
header("location:../views/admin/proveedorcrear.php?msg={$msg}");
?>
