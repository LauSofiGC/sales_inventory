<?php

namespace app\ventas\controller;

use app\ventas\repos\tickettaxproductrepo;
use app\ventas\model\tickettaxproduct;

class tickettaxproductcontroller {

    private $_objtTiTaPro;

    public function __construct() {
        $this->_objtTiTaPro = new tickettaxproductrepo();
    }

    public function getAllTiTaPro(): array {
        return $this->_objtTiTaPro->getAllTiTaPro();
    }

    public function getAllTi(): array {
        return $this->_objtTiTaPro->getAllTi();
    }

    public function getFacturaDetalle(int $idFac): array {
        return $this->_objtTiTaPro->getFacturaDetalle($idFac);
    }
    
            public function getFilteredFacturaDetalle(int $idFac):array{
                return $this->_objtTiTaPro->getFilteredFacturaDetalle($idFac);
            }

}

?>