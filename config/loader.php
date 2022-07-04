<?php

ini_set("display_errors", "1");
error_reporting(E_ALL);

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

function autoload($name) {
    $configPath = "config";
    $currentPath = str_replace("\\", "/", __DIR__);
    $myclass = strtolower($name);
    $classPath = str_replace("\\", "/", $name);
    $projectPath = str_replace($configPath, "", $currentPath);

    $finalPath = $projectPath . "" . $classPath . ".php";
    require ($finalPath);
}

spl_autoload_register("autoload");
require_once 'constants.php';
?>