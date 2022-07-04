<?php

namespace app\ventas\controller;

use app\ventas\repos\proveedorrepo;
use app\ventas\model\provider;

class proveedorcontroller {

    private $_objPer;

    public function __construct() {
        $this->_objPer = new proveedorrepo();
    }

    public function getAll(): array {
        return $this->_objPer->getAll();
    }

    public function addPerson(provider $obj): bool {
        return $this->_objPer->addPerson($obj);
    }
    
    public function getAllDropDown(): array {
        return $this->_objPer->getAllDropDown();
    }

}

?>
