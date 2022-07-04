<?php

namespace app\ventas\controller;

use app\ventas\repos\rolrepo;
use app\ventas\model\role;

class rolcontroller {

    private $_objRol;

    public function __construct() {
        $this->_objRol = new rolrepo();
    }

    public function getAllRol(): array {
        return $this->_objRol->getAllRol();
    }
    
       public function getAllDropDown(): array {
        return $this->_objRol->getAllDropDown();
    }

    public function addRol(role $obj): bool {
        return $this->_objRol->addRol($obj);
    }

    public function deleteRol(role $objeto): bool {
        return $this->_objRol->deleteRol($objeto);
    }

    public function getOne(role $obj): role {
        return $this->_objRol->getOne($obj);
    }

    public function updateRol(role $obj): bool {
        return $this->_objRol->updateRol($obj);
    }

}

?>

