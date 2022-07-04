<?php

require_once '../../../config/loader.php';

use app\ventas\controller\loginfacade;
use app\ventas\model\person;

$objPer = new person();
$loginFacade = new loginfacade();

$correo = filter_input(INPUT_POST, "usuario");
$clave = filter_input(INPUT_POST, "clave");

$objPer->set_correo($correo);
$objPer->set_clave($clave);

$personId = $loginFacade->isValidatePerson($objPer);

if (!empty($personId)) {
    $paginaRet = "../views/index.php";

    $objPer->set_idPerson($personId);
    $arr = $loginFacade->getProfiles($objPer);
    $arr[] = "*";
    
      echo "<pre>";
    print_r($arr);
   echo "<pre/>";

    //fortalecer y usar Sal para autorización - USO DE SESIONES
    session_start();
    $salt = $correo . $DOMAINS["SALT"]["KEY"];
    $_SESSION["username"] = $correo;
    $_SESSION["userkey"] = hash("sha512", $salt);
    $_SESSION["userprof"] = $arr;
} else {
   $msg = 100;
   $paginaRet = "../../../public/login.php?msg={$msg}";
}

header("location:{$paginaRet}");
?>

