<?php

namespace app\ventas\controller;

use app\ventas\repos\productorepo;

class ventascontroller {

    private $_objVentas;

    public function __construct() {
        $this->_objVentas = new productorepo();
    }

    public function addProductTicket(string $Tax_Product_idTax_Product, string $Ticket_idTicket, string $devDate): bool {
        return $this->_objVentas->addProductTicket($Tax_Product_idTax_Product, $Ticket_idTicket, $devDate);
    }

    public function getTotalprice(int $idTicket): bool {
        return $this->_objVentas->getTotalprice($idTicket);
    }
    
     public function resProduct(string $codProdTax): bool{
         return $this->_objVentas->resProduct($codProdTax);
     }
     
         public function getIdProd(string $codProdTax):int {
             return $this->_objVentas->getIdProd($codProdTax);
         }

}
?>

