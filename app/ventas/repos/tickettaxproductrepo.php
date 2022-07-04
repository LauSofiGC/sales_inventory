<?php

namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\tickettaxproduct;

class tickettaxproductrepo extends conn {
        public function getAllTiTaPro(): array {
        $sql = "SELECT t.idTicket_TAX_PRODUCT, t.dateTicketTaxProductDevolution, t.Tax_Product_idTax_Product, t.Ticket_idTicket  ";
        $sql .= "FROM TICKET_TAX_PRODUCT t ";
        $sql .= "ORDER BY t.idTicket_TAX_PRODUCT DESC ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    
    public function getAllTi():array {
        $sql = "SELECT t.idTicket, t.ticketDate, "
                . "(SELECT name FROM PERSON WHERE idPerson=t.Person_idPerson) AS nomP, "
                . "(SELECT documentPerson FROM PERSON WHERE idPerson=t.Person_idPerson) AS docP ";
        $sql .= "FROM TICKET t ";
        $sql .= "ORDER BY t.idTicket DESC ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    
    public function getFacturaDetalle(int $idFac):array{
        $sql = "SELECT t.idTicket_TAX_PRODUCT, t.dateTicketTaxProductDevolution, "
                . "(SELECT Product_idProduct FROM TAX_PRODUCT WHERE idTAX_PRODUCT = t.Tax_Product_idTax_Product) AS idProd, "
                . "(SELECT nameProduct FROM PRODUCT WHERE idPRODUCT = idProd) AS prodNam, "
                . "(SELECT precio FROM TAX_PRODUCT WHERE idTAX_PRODUCT = t.Tax_Product_idTax_Product) AS precioProd ";
        $sql .= "FROM TICKET_TAX_PRODUCT t ";
        $sql .= "WHERE Ticket_idTicket = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $idFac);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;   
    }
    
        public function getFilteredFacturaDetalle(int $idFac):array{
        $sql = "SELECT t.idTicket_TAX_PRODUCT, t.dateTicketTaxProductDevolution, "
                . "(SELECT Product_idProduct FROM TAX_PRODUCT WHERE idTAX_PRODUCT = t.Tax_Product_idTax_Product) AS idProd, "
                . "(SELECT nameProduct FROM PRODUCT WHERE idPRODUCT = idProd) AS prodNam, "
                . "(SELECT precio FROM TAX_PRODUCT WHERE idTAX_PRODUCT = t.Tax_Product_idTax_Product) AS precioProd ";
        $sql .= "FROM TICKET_TAX_PRODUCT t ";
        $sql .= "WHERE Ticket_idTicket = ? AND NOT EXISTS (SELECT idDevolution FROM DEVOLUTION d WHERE d.Ticket_tax_product_idTicTaxPro = t.idTicket_TAX_PRODUCT)";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $idFac);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;   
    }
}
