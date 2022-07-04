<?php

namespace app\ventas\controller;

use app\ventas\repos\tiporepo;
use app\ventas\model\prodtype;

class tipocontroller {

    private $_objTipo;

    public function __construct() {
        $this->_objTipo = new tiporepo();
    }

    public function getAllTipo(): array {
        return $this->_objTipo->getAllTipo();
    }

    public function addType(prodtype $obj): bool {
        return $this->_objTipo->addType($obj);
    }

    public function deleteType(prodtype $objeto): bool {
        return $this->_objTipo->deleteType($objeto);
    }

    public function getOne(prodtype $obj): prodtype {
        return $this->_objTipo->getOne($obj);
    }
    
    public function updateType(prodtype $obj): bool {
        return $this->_objTipo->updateType($obj);
    }
    
    public function getAllDropDown(): array {
        return $this->_objTipo->getAllDropDown();
    }

}

?>
