<?php

namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\product;

class productorepo extends conn {

    public function getAllProd(): array {
        $sql = "SELECT p.idPRODUCT, p.nameProduct, p.productState, "
                . "(SELECT providerName FROM PROVIDER WHERE idProvider=p.provider_idProvider) AS provName, "
                . "(SELECT enterpriseName FROM ENTERPRISE WHERE idEnterprise=p.enterprise_idEnterprise) AS entName, "
                . "(SELECT nameProductType FROM PRODUCTTYPE WHERE idPRODUCTType=p.productType_idproductType) AS prodTyName, "
                . "p.precioBruto, p.quantity  ";
        $sql .= "FROM PRODUCT p ";
        $sql .= "ORDER BY p.idPRODUCT ASC ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getOne(product $obj): product {
        $cod = $obj->get_idProduct();
        $sql = "SELECT p.idPRODUCT, p.nameProduct, p.productState, p.provider_idProvider, p.enterprise_idEnterprise, p.productType_idproductType, p.precioBruto, p.quantity ";
        $sql .= "FROM PRODUCT p ";
        $sql .= "WHERE p.idPRODUCT = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $cod);
        $resource->execute();
        $row = $resource->fetchAll(PDO::FETCH_ASSOC);

        $obj->set_idProduct($row[0]["idPRODUCT"]);
        $obj->set_nameProduct($row[0]["nameProduct"]);
        $obj->set_productState($row[0]["productState"]);
        $obj->set_idProvider($row[0]["provider_idProvider"]);
        $obj->set_idEnterprise($row[0]["enterprise_idEnterprise"]);
        $obj->set_idProductType($row[0]["productType_idproductType"]);
        $obj->set_precioBruto($row[0]["precioBruto"]);
        $obj->set_quantity($row[0]["quantity"]);

        return $obj;
    }

    public function addProduct(product $obj): bool {
        $nombre = $obj->get_nameProduct();
        $prodSta = $obj->get_productState();
        $prov = $obj->get_idProvider();
        $ente = $obj->get_idEnterprise();
        $prodTy = $obj->get_idProductType();
        $precBrut = $obj->get_precioBruto();
        $quan = $obj->get_quantity();
        $sql = "INSERT INTO PRODUCT(nameProduct, productState, provider_idProvider, enterprise_idEnterprise, productType_idproductType, precioBruto, quantity) VALUES (?,?,?,?,?,?,?) ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $nombre);
        $resource->bindParam(2, $prodSta);
        $resource->bindParam(3, $prov);
        $resource->bindParam(4, $ente);
        $resource->bindParam(5, $prodTy);
        $resource->bindParam(6, $precBrut);
        $resource->bindParam(7, $quan);
        return $resource->execute();
    }

    public function deleteProduct(product $objeto): bool {
        $id = $objeto->get_idProduct();
        $sql = "DELETE FROM PRODUCT WHERE idPRODUCT = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $id);
        return $resource->execute();
    }

    public function updateProd(product $obj): bool {
        $nombre = $obj->get_nameProduct();
        $cod = $obj->get_idProduct();
        $prodSta = $obj->get_productState();
        $prov = $obj->get_idProvider();
        $ente = $obj->get_idEnterprise();
        $prodTy = $obj->get_idProductType();
        $precBrut = $obj->get_precioBruto();
        $sql = "UPDATE PRODUCT "
                . "SET nameProduct = ?, productState = ?, provider_idProvider = ?, enterprise_idEnterprise = ?, "
                . "productType_idproductType = ?, precioBruto = ? "
                . "WHERE idPRODUCT = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $nombre);
        $resource->bindParam(2, $prodSta);
        $resource->bindParam(3, $prov);
        $resource->bindParam(4, $ente);
        $resource->bindParam(5, $prodTy);
        $resource->bindParam(6, $precBrut);
        $resource->bindParam(7, $cod);
        return $resource->execute();
    }

    public function getAllDropDown(): array {
        $sql = "SELECT p.idPRODUCT, p.nameProduct, p.productState, p.provider_idProvider, p.enterprise_idEnterprise, p.productType_idproductType, p.precioBruto, p.quantity "
                . "FROM PRODUCT p ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $finalArray = [];
        foreach ($rows as $index => $column) {
            $cod = $column["idPRODUCT"];
            $nom = $column["nameProduct"];
            $finalArray[$cod] = $nom;
        }
        return $finalArray;
    }

    public function addProductTicket(string $codProdTax, string $codTicket, string $devDate): bool {
        $sql = "INSERT INTO TICKET_TAX_PRODUCT (Tax_Product_idTax_Product, Ticket_idTicket, dateTicketTaxProductDevolution) VALUES (?,?,?)";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $codProdTax);
        $resource->bindParam(2, $codTicket);
        $resource->bindParam(3, $devDate);
        //$sql2 = "UPDATE PRODUCT SET quantity = quantity - 1 "
        //      ."INNER JOIN TAX_PRODUCT ON TAX_PRODUCT.idTAX_PRODUCT = TICKET_TAX_PRODUCT.Tax_Product_idTax_Product AS TaxP"
        //    . "INNER JOIN  "
        //  . "WHERE TAX_PRODUCT.Product_idProduct = PRODUCT.idPRODUCT";
        //$resource2 = $this->_conn->prepare($sql2);
        //$resource2->execute();
        return $resource->execute();
    }

    public function resProduct(string $codProdTax): bool {
        $sql = "UPDATE PRODUCT p SET quantity = quantity - 1 "
                . "WHERE p.idPRODUCT  = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $codProdTax);
        return $resource->execute();
    }

    public function getIdProd(string $codProdTax): int {
        $sql = "SELECT Product_idProduct AS idProd FROM TAX_PRODUCT WHERE idTAX_PRODUCT  = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $codProdTax);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $id = 0;
        foreach ($rows as $index => $column) {
            $id = $column["idProd"];
        }
        return $id;
    }

    public function getTotalprice(int $idTicket): int {
        $sql = "SELECT SUM(precio) AS suma FROM TAX_PRODUCT tp "
                . "INNER JOIN TICKET_TAX_PRODUCT ttp ON ttp.Tax_Product_idTax_Product=tp.idTAX_PRODUCT "
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

    public function getPrecioBrutoTotal(int $idTicket): int {
        $sql = "SELECT SUM(precioBruto) AS totBrut "
                . "FROM (product p INNER JOIN tax_product tp ON tp.Product_idProduct=p.idPRODUCT ) "
                . "INNER JOIN ticket_tax_product ttp ON tp.idTAX_PRODUCT=ttp.Tax_Product_idTax_Product "
                . "WHERE ttp.Ticket_idTicket = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $idTicket);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $id = 0;
        foreach ($rows as $index => $column) {
            $id = $column["totBrut"];
        }
        return $id;
    }
    
    public function getImpuestoTot(int $idTicket): int {
        $sql = "SELECT SUM(valorimp) AS totImp "
                . "FROM tax_product tp INNER JOIN ticket_tax_product ttp ON tp.idTAX_PRODUCT = ttp.Tax_Product_idTax_Product "
                . "WHERE ttp.Ticket_idTicket = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $idTicket);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $id = 0;
        foreach ($rows as $index => $column) {
            $id = $column["totImp"];
        }
        return $id;
    }

    public function updateQuan(string $codProducto, string $quan, string $precio): bool {
        $sql = "UPDATE PRODUCT SET quantity = quantity + ?, precioBruto = ? WHERE idPRODUCT = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $quan);
        $resource->bindParam(2, $precio);
        $resource->bindParam(3, $codProducto);
        return $resource->execute();
    }

    public function getTaxProd(string $codProd): array {
        $sql = "SELECT * FROM TAX_PRODUCT tp WHERE tp.Product_idProduct = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $codProd);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function updateTotalPrice(string $codProd): bool {
        $sql = "UPDATE TAX_PRODUCT tp SET precio = ((SELECT precioBruto FROM PRODUCT p WHERE p.idPRODUCT = ?)*"
                . "(SELECT value FROM TAX t INNER JOIN TAX_PRODUCT tp ON t.idTAX = tp.Tax_idTax  WHERE tp.Product_idProduct = ?)+"
                . "(SELECT precioBruto FROM PRODUCT p WHERE p.idPRODUCT = ?)) WHERE tp.Product_idProduct = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $codProd);
        $resource->bindParam(2, $codProd);
        $resource->bindParam(3, $codProd);
        $resource->bindParam(4, $codProd);
        return $resource->execute();
    }

    public function updateTaxValue(string $codProd): bool {
        $sql = "UPDATE TAX_PRODUCT tp SET valorimp = ((SELECT precioBruto FROM PRODUCT p WHERE p.idPRODUCT = ?)*"
                . "(SELECT value FROM TAX t INNER JOIN TAX_PRODUCT tp ON t.idTAX = tp.Tax_idTax  WHERE tp.Product_idProduct = ?)) "
                . "WHERE tp.Product_idProduct = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $codProd);
        $resource->bindParam(2, $codProd);
        $resource->bindParam(3, $codProd);
        return $resource->execute();
    }

}

?>
