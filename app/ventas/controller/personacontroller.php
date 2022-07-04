<?php

namespace app\ventas\controller;

use app\ventas\repos\personarepo;
use app\ventas\model\person;

class personacontroller {

    private $_objPer;

    public function __construct() {
        $this->_objPer = new personarepo();
    }

    public function getAll(): array {
        return $this->_objPer->getAll();
    }

    public function addPerson(person $obj): bool {
        return $this->_objPer->addPerson($obj);
    }

    public function addClient(person $objeto): bool {
        return $this->_objPer->addClient($objeto);
    }

    public function deletePerson(person $objeto): bool {
        return $this->_objPer->deletePerson($objeto);
    }

    public function getOne(person $obj): person {
        return $this->_objPer->getOne($obj);
    }

    public function updatePerson(person $obj): bool {
        return $this->_objPer->updatePerson($obj);
    }

    public function getAllDropDown(): array {
        return $this->_objPer->getAllDropDown();
    }

}

?>
