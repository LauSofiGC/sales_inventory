<?php

require_once '../../../config/loader.php';

use app\ventas\controller\personacontroller;
use app\ventas\model\person;

$docPersona = filter_input(INPUT_POST, "cajaDocPersona");
$codRol = "3";
$nom = filter_input(INPUT_POST, "cajaNomPersona");

$personaObj = new person();
$facadePersona = new personacontroller();

$personaObj->set_docPerson($docPersona);
$personaObj->set_idRole($codRol);
$personaObj->set_nombreP($nom);

if ($facadePersona->addClient($personaObj)) {
    $msg = 19;
} else {
    $msg = 20;
}
header("location:../views/clientecrear.php?msg={$msg}");
?>
