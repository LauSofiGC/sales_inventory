<?php

namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\taxproduct;

class prodimprepo extends conn {

    public function getNumRecords(): int {
        $sql = "SELECT COUNT(t.idTAX_PRODUCT) AS numProds FROM TAX_PRODUCT t";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $num = 0;
        foreach ($rows as $index => $column) {
            $num = $column["numProds"];
        }
        return $num;
    }

    public function getAllProdImp(): array {
        $sql = "SELECT t.idTAX_PRODUCT , t.dateInit, t.precio, "
                . "(SELECT nameProduct FROM PRODUCT p WHERE idPRODUCT=t.Product_idProduct ) AS nomProd ,"
                . "(SELECT nameProductType FROM (producttype pt INNER JOIN product p ON p.productType_idproductType = pt.idPRODUCTType) WHERE  idPRODUCT=t.Product_idProduct ) AS prodType, "
                . "(SELECT taxName FROM TAX WHERE idTAX=t.Tax_idTax ) AS nomTax, "
                . "(SELECT quantity FROM PRODUCT p WHERE idPRODUCT=t.Product_idProduct ) AS quan "
                . "FROM TAX_PRODUCT t "
                . "INNER JOIN PRODUCT p ON t.Product_idProduct = p.idPRODUCT "
                . "WHERE p.quantity >0 "
                . "ORDER BY t.idTAX_PRODUCT DESC";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function addProdImp(taxproduct $obj): bool {
        $date = $obj->get_dateInit();
        $idPro = $obj->get_idProduct();
        $idTa = $obj->get_idTax();
        $sql = "INSERT INTO TAX_PRODUCT(dateInit, Product_idProduct, Tax_idTax, valorimp , precio) VALUES (?,?,?, "
                . "((SELECT precioBruto FROM PRODUCT WHERE idPRODUCT = ?)*(SELECT value FROM TAX WHERE idTAX = ?)), "
                . "(((SELECT precioBruto FROM PRODUCT WHERE idPRODUCT = ?)*(SELECT value FROM TAX WHERE idTAX = ?))+(SELECT precioBruto FROM PRODUCT WHERE idPRODUCT = ?)))";
        $resource2 = $this->_conn->prepare($sql);
        $resource2->bindParam(1, $date);
        $resource2->bindParam(2, $idPro);
        $resource2->bindParam(3, $idTa);
        $resource2->bindParam(4, $idPro);
        $resource2->bindParam(5, $idTa);
        $resource2->bindParam(6, $idPro);
        $resource2->bindParam(7, $idTa);
        $resource2->bindParam(8, $idPro);
        return $resource2->execute();
    }

}

?>
