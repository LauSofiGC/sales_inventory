<?php

namespace app\ventas\controller;

use app\ventas\repos\taxrepo;
use app\ventas\model\tax;

class taxcontroller {

    private $_objTax;

    public function __construct() {
        $this->_objTax = new taxrepo();
    }

    public function getAllTax(): array {
        return $this->_objTax->getAllTax();
    }

    public function addTax(tax $obj): bool {
        return $this->_objTax->addTax($obj);
    }

    public function deleteTax(tax $objeto): bool {
        return $this->_objTax->deleteTax($objeto);
    }

    public function getOne(tax $obj): tax {
        return $this->_objTax->getOne($obj);
    }

    public function updateTax(tax $obj): bool {
        return $this->_objTax->updateTax($obj);
    }

    public function getAllDropDown(): array {
        return $this->_objTax->getAllDropDown();
    }

    public function getFiltered(int $cod): array {
        return $this->_objTax->getFiltered($cod);
    }

}

?>
