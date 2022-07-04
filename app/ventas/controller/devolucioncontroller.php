<?php

namespace app\ventas\controller;

use app\ventas\repos\devolucionrepo;
use app\ventas\model\devolucion;

class devolucioncontroller {

    private $_objDevolution;

    public function __construct() {
        $this->_objDevolution = new devolucionrepo();
    }

    public function getAllDevoluciones(): array {
        return $this->_objDevolution->getAllDevoluciones();
    }

    public function getDevolucionIds(int $idFac): array {
        return $this->_objDevolution->getDevolucionIds($idFac);
    }

    public function devDate(): string {
        return $this->_objDevolution->devDate();
    }

    public function addDevolution(string $codTiTaxProd, string $devDate): bool {
        return $this->_objDevolution->addDevolution($codTiTaxProd, $devDate);
    }

    public function verifyDateDev(string $codTiTaxProd, string $devDate): bool {
        return $this->_objDevolution->verifyDateDev($codTiTaxProd, $devDate);
    }

    public function getDevolucionesPendientes(): array {
        return $this->_objDevolution->getDevolucionesPendientes();
    }

    public function getDevolucionesAprobadas(): array {
        return $this->_objDevolution->getDevolucionesAprobadas();
    }

    public function getDevolucionesRechazadas(): array {
        return $this->_objDevolution->getDevolucionesRechazadas();
    }

    public function acepRechDevolucion(int $idDev, int $aprov): bool {
        return $this->_objDevolution->acepRechDevolucion($idDev, $aprov);
    }

    public function getTotalDev(int $idTicket): int {
        return $this->_objDevolution->getTotalDev($idTicket);
    }

    public function getIdProd(int $idDev): int {
        return $this->_objDevolution->getIdProd($idDev);
    }

    public function devolverArticulo(int $idProd): bool {
        return $this->_objDevolution->devolverArticulo($idProd);
    }

}

?>
