<?php

namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\prodtype;

class tiporepo extends conn {

    public function getAllTipo(): array {
        $sql = "SELECT p.idproductType, p.nameProductType, ";
        $sql .= "(SELECT COUNT(productType_idProductType) FROM PRODUCT WHERE productType_idProductType = p.idproductType) AS cantidad ";
        $sql .= "FROM PRODUCTTYPE p ";
        $sql .= "ORDER BY p.idproductType ASC ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getOne(prodtype $obj): prodtype {
        $cod = $obj->getIdproductType();
        $sql = "SELECT p.idproductType, p.nameProductType ";
        $sql .= "FROM PRODUCTTYPE p ";
        $sql .= "WHERE p.idproductType = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $cod);
        $resource->execute();
        $row = $resource->fetchAll(PDO::FETCH_ASSOC);

        $obj->setIdproductType($row[0]["idproductType"]);
        $obj->setNameProductType($row[0]["nameProductType"]);
        return $obj;
    }

    public function addType(prodtype $obj): bool {
        $nombre = $obj->getNameProductType();
        $sql = "INSERT INTO PRODUCTTYPE(nameProductType) VALUES (?) ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $nombre);
        return $resource->execute();
    }

    public function deleteType(prodtype $objeto): bool {
        $id = $objeto->getIdproductType();
        $sql = "DELETE FROM PRODUCTTYPE WHERE idproductType = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $id);
        return $resource->execute();
    }

    public function updateType(prodtype $obj): bool {
        $nombre = $obj->getNameProductType();
        $cod = $obj->getIdproductType();
        $sql = "UPDATE PRODUCTTYPE SET nameProductType = ? WHERE idproductType = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $nombre);
        $resource->bindParam(2, $cod);
        return $resource->execute();
    }

    public function getAllDropDown(): array {
        $sql = "SELECT p.idproductType, p.nameProductType FROM PRODUCTTYPE p ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $finalArray = [];
        foreach ($rows as $index => $column) {
            $cod = $column["idproductType"];
            $nom = $column["nameProductType"];
            $finalArray[$cod] = $nom;
        }
        return $finalArray;
    }
}

?>