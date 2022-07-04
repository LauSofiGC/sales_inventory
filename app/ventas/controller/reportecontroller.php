<?php

namespace app\ventas\controller;

use app\ventas\repos\reporterepo;

class reportecontroller {

    private $_objRep;

    public function __construct() {
        $this->_objRep = new reporterepo();
    }

    public function getProdMasVendAnual(string $anio): array {
        return $this->_objRep->getProdMasVendAnual($anio);
    }

    public function getProdMasVendDia(): array {
        return $this->_objRep->getProdMasVendDia();
    }

    public function getProdMasVendMes(string $mes): array {
        return $this->_objRep->getProdMasVendMes($mes);
    }

    public function getProdMasVendRango(string $f1, string $f2): array {
        return $this->_objRep->getProdMasVendRango($f1, $f2);
    }

    public function getReporteDevolucionesAnio(string $anio): array {
        return $this->_objRep->getReporteDevolucionesAnio($anio);
    }

    public function getReporteDevolucionesDia(): array {
        return $this->_objRep->getReporteDevolucionesDia();
    }
    
    public function getReporteDevolucionesMes(string $mes): array {
        return $this->_objRep->getReporteDevolucionesMes($mes);
    }
        
    public function getReporteDevolucionesRango(string $f1, string $f2): array {
        return $this->_objRep->getReporteDevolucionesRango($f1, $f2);
    }

}

?>
