<?php

namespace app\ventas\repos;

use PDO;
USE config\conn;

class reporterepo extends conn {

    public function getProdMasVendAnual(string $anio): array {
        $sql = "SELECT (SELECT idPRODUCT FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS idProd, "
                . "(SELECT nameProduct FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS prodname, "
                . "count(Tax_Product_idTax_Product) AS cantidad, "
                . "(SELECT precioBruto FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS precioBruto, "
                . "(SELECT nameProductType FROM ((producttype pt INNER JOIN product p ON p.productType_idproductType = pt.idPRODUCTType)INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS nameProTy, "
                . "(SELECT valorimp FROM tax_product tp WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS imp, "
                . "(SELECT precio FROM tax_product tp WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS precioTot "
                . "FROM ticket_tax_product ttp "
                . "INNER JOIN ticket t ON t.idTicket=ttp.Ticket_idTicket "
                . "WHERE YEAR(t.ticketDate) = ? "
                . "GROUP BY ttp.Tax_Product_idTax_Product "
                . "ORDER BY cantidad DESC ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $anio);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getProdMasVendDia(): array {
        $sql = "SELECT (SELECT idPRODUCT FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS idProd, "
                . "(SELECT nameProduct FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS prodname, "
                . "count(Tax_Product_idTax_Product) AS cantidad, "
                . "(SELECT precioBruto FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS precioBruto, "
                . "(SELECT nameProductType FROM ((producttype pt INNER JOIN product p ON p.productType_idproductType = pt.idPRODUCTType)INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS nameProTy, "
                . "(SELECT valorimp FROM tax_product tp WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS imp, "
                . "(SELECT precio FROM tax_product tp WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS precioTot "
                . "FROM ticket_tax_product ttp "
                . "INNER JOIN ticket t ON t.idTicket=ttp.Ticket_idTicket "
                . "WHERE (t.ticketDate) = CURDATE() "
                . "GROUP BY ttp.Tax_Product_idTax_Product "
                . "ORDER BY cantidad DESC ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getProdMasVendMes(string $mes): array {
        $sql = "SELECT (SELECT idPRODUCT FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS idProd, "
                . "(SELECT nameProduct FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS prodname, "
                . "count(Tax_Product_idTax_Product) AS cantidad, "
                . "(SELECT precioBruto FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS precioBruto, "
                . "(SELECT nameProductType FROM ((producttype pt INNER JOIN product p ON p.productType_idproductType = pt.idPRODUCTType)INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS nameProTy, "
                . "(SELECT valorimp FROM tax_product tp WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS imp, "
                . "(SELECT precio FROM tax_product tp WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS precioTot "
                . "FROM ticket_tax_product ttp "
                . "INNER JOIN ticket t ON t.idTicket=ttp.Ticket_idTicket "
                . "WHERE MONTH(t.ticketDate) = ? "
                . "GROUP BY ttp.Tax_Product_idTax_Product "
                . "ORDER BY cantidad DESC ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $mes);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getProdMasVendRango(string $f1, string $f2): array {
        $sql = "SELECT (SELECT idPRODUCT FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS idProd, "
                . "(SELECT nameProduct FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS prodname, "
                . "count(Tax_Product_idTax_Product) AS cantidad, "
                . "(SELECT precioBruto FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS precioBruto, "
                . "(SELECT nameProductType FROM ((producttype pt INNER JOIN product p ON p.productType_idproductType = pt.idPRODUCTType)INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT) WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS nameProTy, "
                . "(SELECT valorimp FROM tax_product tp WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS imp, "
                . "(SELECT precio FROM tax_product tp WHERE ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) AS precioTot "
                . "FROM ticket_tax_product ttp "
                . "INNER JOIN ticket t ON t.idTicket=ttp.Ticket_idTicket "
                . "WHERE t.ticketDate BETWEEN ? AND ? "
                . "GROUP BY ttp.Tax_Product_idTax_Product "
                . "ORDER BY cantidad DESC ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $f1);
        $resource->bindParam(2, $f2);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getTotalVentas($param) {
        
    }

    public function getReporteDevolucionesAnio(string $anio): array {
        $sql = "SELECT idDevolution, approved,"
                . "(SELECT Ticket_idTicket FROM ticket_tax_product ttp WHERE d.Ticket_tax_product_idTicTaxPro=ttp.idTicket_TAX_PRODUCT) AS tickId, "
                . "(SELECT name FROM (person p INNER JOIN ticket t ON p.idPerson=t.Person_idPerson) INNER JOIN ticket_tax_product ttp ON ttp.Ticket_idTicket=t.idTicket WHERE d.Ticket_tax_product_idTicTaxPro=ttp.idTicket_TAX_PRODUCT) AS nameClient, "
                . "(SELECT ticketDate FROM (ticket t INNER JOIN ticket_tax_product ttp ON ttp.Ticket_idTicket=t.idTicket) WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro) AS tickDate, "
                . "dateDevolution, "
                . "(SELECT nameProduct FROM ((product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT)INNER JOIN ticket_tax_product ttp ON ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro) AS nomProd, "
                . "(SELECT precio FROM tax_product tp INNER JOIN ticket_tax_product ttp ON ttp.Tax_Product_idTax_Product=tp.idTAX_PRODUCT WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro)AS precio "
                . "FROM (devolution d INNER JOIN ticket_tax_product ttp ON ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro)"
                . "INNER JOIN ticket t ON t.idTicket=ttp.Ticket_idTicket "
                . "WHERE YEAR(d.dateDevolution) = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $anio);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getReporteDevolucionesDia(): array {
        $sql = "SELECT idDevolution, approved,"
                . "(SELECT Ticket_idTicket FROM ticket_tax_product ttp WHERE d.Ticket_tax_product_idTicTaxPro=ttp.idTicket_TAX_PRODUCT) AS tickId, "
                . "(SELECT name FROM (person p INNER JOIN ticket t ON p.idPerson=t.Person_idPerson) INNER JOIN ticket_tax_product ttp ON ttp.Ticket_idTicket=t.idTicket WHERE d.Ticket_tax_product_idTicTaxPro=ttp.idTicket_TAX_PRODUCT) AS nameClient, "
                . "(SELECT ticketDate FROM (ticket t INNER JOIN ticket_tax_product ttp ON ttp.Ticket_idTicket=t.idTicket) WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro) AS tickDate, "
                . "dateDevolution, "
                . "(SELECT nameProduct FROM ((product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT)INNER JOIN ticket_tax_product ttp ON ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro) AS nomProd, "
                . "(SELECT precio FROM tax_product tp INNER JOIN ticket_tax_product ttp ON ttp.Tax_Product_idTax_Product=tp.idTAX_PRODUCT WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro)AS precio "
                . "FROM (devolution d INNER JOIN ticket_tax_product ttp ON ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro)"
                . "INNER JOIN ticket t ON t.idTicket=ttp.Ticket_idTicket "
                . "WHERE d.dateDevolution = CURDATE()";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getReporteDevolucionesMes(string $mes): array {
        $sql = "SELECT idDevolution, approved,
                (SELECT Ticket_idTicket FROM ticket_tax_product ttp WHERE d.Ticket_tax_product_idTicTaxPro=ttp.idTicket_TAX_PRODUCT) AS tickId, 
                (SELECT name FROM (person p INNER JOIN ticket t ON p.idPerson=t.Person_idPerson) INNER JOIN ticket_tax_product ttp ON ttp.Ticket_idTicket=t.idTicket WHERE d.Ticket_tax_product_idTicTaxPro=ttp.idTicket_TAX_PRODUCT) AS nameClient, 
                (SELECT ticketDate FROM (ticket t INNER JOIN ticket_tax_product ttp ON ttp.Ticket_idTicket=t.idTicket) WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro) AS tickDate, 
                dateDevolution, 
                (SELECT nameProduct FROM ((product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT)INNER JOIN ticket_tax_product ttp ON ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro) AS nomProd, 
                (SELECT precio FROM tax_product tp INNER JOIN ticket_tax_product ttp ON ttp.Tax_Product_idTax_Product=tp.idTAX_PRODUCT WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro)AS precio 
                FROM (devolution d INNER JOIN ticket_tax_product ttp ON ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro)
                INNER JOIN ticket t ON t.idTicket=ttp.Ticket_idTicket 
                WHERE MONTH(d.dateDevolution) = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $mes);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getReporteDevolucionesRango(string $f1, string $f2): array {
        $sql = "SELECT idDevolution, approved,
                (SELECT Ticket_idTicket FROM ticket_tax_product ttp WHERE d.Ticket_tax_product_idTicTaxPro=ttp.idTicket_TAX_PRODUCT) AS tickId, 
                (SELECT name FROM (person p INNER JOIN ticket t ON p.idPerson=t.Person_idPerson) INNER JOIN ticket_tax_product ttp ON ttp.Ticket_idTicket=t.idTicket WHERE d.Ticket_tax_product_idTicTaxPro=ttp.idTicket_TAX_PRODUCT) AS nameClient, 
                (SELECT ticketDate FROM (ticket t INNER JOIN ticket_tax_product ttp ON ttp.Ticket_idTicket=t.idTicket) WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro) AS tickDate, 
                dateDevolution, 
                (SELECT nameProduct FROM ((product p INNER JOIN tax_product tp ON tp.Product_idProduct= p.idPRODUCT)INNER JOIN ticket_tax_product ttp ON ttp.Tax_Product_idTax_Product = tp.idTAX_PRODUCT) WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro) AS nomProd, 
                (SELECT precio FROM tax_product tp INNER JOIN ticket_tax_product ttp ON ttp.Tax_Product_idTax_Product=tp.idTAX_PRODUCT WHERE ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro)AS precio 
                FROM (devolution d INNER JOIN ticket_tax_product ttp ON ttp.idTicket_TAX_PRODUCT=d.Ticket_tax_product_idTicTaxPro)
                INNER JOIN ticket t ON t.idTicket=ttp.Ticket_idTicket 
                WHERE d.dateDevolution BETWEEN ? AND ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $f1);
        $resource->bindParam(2, $f2);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    
    public function getProductosAgotados():array{
        $sql = "SELECT idPRODUCT , nameProduct, ";
    }

}
