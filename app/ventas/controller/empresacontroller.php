<?php

namespace app\ventas\controller;

use app\ventas\repos\empresarepo;
use app\ventas\model\enterprise;

class empresacontroller {

    private $_objEmp;

    public function __construct() {
        $this->_objEmp = new empresarepo();
    }

    public function getAllDropDown(): array {
        return $this->_objEmp->getAllDropDown();
    }

}
?>

