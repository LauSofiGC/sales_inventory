<?php

namespace app\ventas\controller;

use app\ventas\repos\prodimprepo;
use app\ventas\model\taxproduct;

class prodimpcontroller {

    private $_objPer;

    public function __construct() {
        $this->_objPer = new prodimprepo();
    }

    public function getNumRecords(): int {
        return $this->_objPer->getNumRecords();
    }

    public function getAll(): array {
        return $this->_objPer->getAllProdImp();
    }

    public function addPerson(taxproduct $obj): bool {
        return $this->_objPer->addProdImp($obj);
    }

    public function deletePerson(taxproduct $objeto): bool {
        return $this->_objPer->deletePerson($objeto);
    }

    public function getOne(person $obj): taxproduct {
        return $this->_objPer->getOne($obj);
    }

    public function updatePerson(taxproduct $obj): bool {
        return $this->_objPer->updatePerson($obj);
    }

}

?>
