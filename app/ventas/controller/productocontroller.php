<?php

namespace app\ventas\controller;

use app\ventas\repos\productorepo;
use app\ventas\model\product;

class productocontroller {

    private $_objTax;

    public function __construct() {
        $this->_objTax = new productorepo();
    }

    public function getAllProd(): array {
        return $this->_objTax->getAllProd();
    }

    public function addProduct(product $obj): bool {
        return $this->_objTax->addProduct($obj);
    }

    public function deleteProduct(product $objeto): bool {
        return $this->_objTax->deleteProduct($objeto);
    }

    public function getOne(product $obj): product {
        return $this->_objTax->getOne($obj);
    }

    public function updateProd(product $obj): bool {
        return $this->_objTax->updateProd($obj);
    }

    public function getAllDropDown(): array {
        return $this->_objTax->getAllDropDown();
    }

    public function updateQuan(string $codProducto, string $quan, string $precio): bool {
        return $this->_objTax->updateQuan($codProducto, $quan, $precio);
    }

    public function getTotalprice(int $idTicket): int {
        return $this->_objTax->getTotalprice($idTicket);
    }

    public function getPrecioBrutoTotal(int $idTicket): int {
        return $this->_objTax->getPrecioBrutoTotal($idTicket);
    }
    
        public function getImpuestoTot(int $idTicket): int {
            return $this->_objTax->getImpuestoTot($idTicket);
        }

    public function getTaxProd(string $codProd): array {
        return $this->_objTax->getTaxProd($codProd);
    }

    public function updateTotalPrice(string $codProd): bool {
        return $this->_objTax->updateTotalPrice($codProd);
    }

    public function updateTaxValue(string $codProd): bool {
        return $this->_objTax->updateTaxValue($codProd);
    }

}

?>
