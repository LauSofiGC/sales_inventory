<?php

require_once '../../../config/loader.php';

use app\ventas\controller\personacontroller;
use app\ventas\model\person;

$docPersona = filter_input(INPUT_POST, "cajaDocPersona");
$codRol = filter_input(INPUT_POST, "cajaCodigoRol");
$email = filter_input(INPUT_POST, "cajaEmailPersona");
$cla = filter_input(INPUT_POST, "cajaClave");
$nom = filter_input(INPUT_POST, "cajaNomPersona");

$personaObj = new person();
$facadePersona = new personacontroller();

$personaObj->set_docPerson($docPersona);
$personaObj->set_idRole($codRol);
$personaObj->set_correo($email);
$personaObj->set_clave($cla);
$personaObj->set_nombreP($nom);

if ($facadePersona->addPerson($personaObj)) {
    $msg = 19;
} else {
    $msg = 20;
}
header("location:../views/personacrear.php?msg={$msg}");
?>
