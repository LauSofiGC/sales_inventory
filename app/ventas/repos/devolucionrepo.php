<?php

namespace app\ventas\repos;

use PDO;
use config\conn;

class devolucionrepo extends conn {

    public function verificarExiste(int $idBuscar): int {
        $sql = "SELECT EXISTS (SELECT * FROM TICKET WHERE idTicket = ?) AS exist";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $idBuscar);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $id = 0;
        foreach ($rows as $index => $column) {
            $id = $column["exist"];
        }
        return $id;
    }

    public function getDevolucionDetalle(int $codFac): array {
        
    }

    public function devDate(): string {
        $sql = "SELECT NOW() AS dateDev";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);

        $dateDev = "";
        foreach ($rows as $index => $column) {
            $dateDev = $column["dateDev"];
        }
        return $dateDev;
    }

    public function addDevolution(string $codTiTaxProd, string $devDate): bool {
        $appro = 0;
        $sql = "INSERT INTO DEVOLUTION (dateDevolution, Ticket_tax_product_idTicTaxPro, approved) VALUES (?,?,?)";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $devDate);
        $resource->bindParam(2, $codTiTaxProd);
        $resource->bindParam(3, $appro);
        return $resource->execute();
    }

    public function verifyDateDev(string $codTiTaxProd, string $devDate): bool {
        $sql = "SELECT (SELECT dateTicketTaxProductDevolution FROM TICKET_TAX_PRODUCT ttp WHERE ttp.idTicket_TAX_PRODUCT = ?) AS dateTiTaPro";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $codTiTaxProd);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $date = new \DateTime();
        foreach ($rows as $index => $column) {
            $date = new \DateTime($column["dateTiTaPro"]);
        }
        if (new \DateTime($devDate) <= $date) {
            return true;
        } else {
            return false;
        }
    }

    public function getTotalDev(int $idTicket): int {
        $sql = "SELECT SUM(precio) AS suma FROM (TAX_PRODUCT tp "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product)  "
                . "INNER JOIN DEVOLUTION d ON d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT "
                . "WHERE ttp.Ticket_idTicket = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $idTicket);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $id = 0;
        foreach ($rows as $index => $column) {
            $id = $column["suma"];
        }
        return $id;
    }

    public function getDevolucionIds(int $idFac): array {
        $sql = "SELECT idDevolution, dateDevolution,"
                . " (SELECT nameProduct FROM (PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS prodname,"
                . "(SELECT precio FROM TAX_PRODUCT tp INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS prodprecio, "
                . "(SELECT precioBruto FROM (PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS precioBruto, "
                . "(SELECT valorimp FROM TAX_PRODUCT tp INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS impuestoprecio, "
                . "approved "
                . " FROM DEVOLUTION d "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT "
                . "WHERE ttp.Ticket_idTicket = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $idFac);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getAllDevoluciones(): array {
        $sql = "SELECT d.idDevolution  , d.dateDevolution, "
                . "(SELECT nameProduct FROM (PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS prodname, "
                . "(SELECT precio FROM TAX_PRODUCT tp INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS prodprecio, "
                . "(SELECT precioBruto FROM (PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS precioBruto, "
                . "(SELECT valorimp FROM TAX_PRODUCT tp INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS impuestoprecio "
                . "FROM DEVOLUTION d ORDER BY d.idDevolution ASC";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getDevolucionesPendientes(): array {
        $sql = "SELECT d.idDevolution  , d.dateDevolution, "
                . "(SELECT nameProduct FROM (PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS prodname, "
                . "(SELECT precio FROM TAX_PRODUCT tp INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS prodprecio, "
                . "(SELECT precioBruto FROM (PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS precioBruto, "
                . "(SELECT valorimp FROM TAX_PRODUCT tp INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS impuestoprecio "
                . "FROM DEVOLUTION d "
                . "WHERE d.approved = 0  "
                . "ORDER BY d.idDevolution ASC";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getDevolucionesAprobadas(): array {
        $sql = "SELECT d.idDevolution  , d.dateDevolution, d.approved, "
                . "(SELECT nameProduct FROM (PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS prodname, "
                . "(SELECT precio FROM TAX_PRODUCT tp INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS prodprecio, "
                . "(SELECT precioBruto FROM (PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS precioBruto, "
                . "(SELECT valorimp FROM TAX_PRODUCT tp INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS impuestoprecio "
                . "FROM DEVOLUTION d "
                . "WHERE d.approved = 1  "
                . "ORDER BY d.idDevolution ASC";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getDevolucionesRechazadas(): array {
        $sql = "SELECT d.idDevolution  , d.dateDevolution, d.approved, "
                . "(SELECT nameProduct FROM (PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS prodname, "
                . "(SELECT precio FROM TAX_PRODUCT tp INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS prodprecio, "
                . "(SELECT precioBruto FROM (PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS precioBruto, "
                . "(SELECT valorimp FROM TAX_PRODUCT tp INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE d.Ticket_tax_product_idTicTaxPro = ttp.idTicket_TAX_PRODUCT) AS impuestoprecio "
                . "FROM DEVOLUTION d "
                . "WHERE d.approved = 2  "
                . "ORDER BY d.idDevolution ASC";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function acepRechDevolucion(int $idDev, int $aprov): bool {
        $sql = "UPDATE DEVOLUTION "
                . "SET approved = ? "
                . "WHERE idDevolution = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $aprov);
        $resource->bindParam(2, $idDev);
        return $resource->execute();
    }
    
    public function getIdProd(int $idDev):int {
        $sql = " SELECT idPRODUCT AS prod FROM ((PRODUCT p INNER JOIN TAX_PRODUCT tp ON p.idPRODUCT = tp.Product_idProduct) "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product) "
                . "INNER JOIN DEVOLUTION d ON ttp.idTicket_TAX_PRODUCT = d.Ticket_tax_product_idTicTaxPro "
                . "WHERE d.idDevolution = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $idDev);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $id = 0;
        foreach ($rows as $index => $column) {
            $id = $column["prod"];
        }
        return $id;
    }
    
    public function devolverArticulo(int $idProd):bool {
        $sql = "UPDATE PRODUCT SET quantity = quantity + 1 WHERE idPRODUCT = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $idProd);
        return $resource->execute();   
    }

}

?>
