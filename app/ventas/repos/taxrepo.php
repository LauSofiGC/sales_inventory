<?php

namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\tax;

class taxrepo extends conn {

    public function getAllTax(): array {
        $sql = "SELECT t.idTax, t.taxName, ";
        $sql .= "(SELECT COUNT(Tax_idTax) FROM TAX_PRODUCT WHERE Tax_idTax = t.idTax) AS cantidad ";
        $sql .= "FROM TAX t ";
        $sql .= "ORDER BY t.idTax ASC ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getAllDropDown(): array {
        $sql = "SELECT t.idTAX , t.taxName FROM TAX t ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $finalArray = [];
        foreach ($rows as $index => $column) {
            $cod = $column["idTAX"];
            $nom = $column["taxName"];
            $finalArray[$cod] = $nom;
        }
        return $finalArray;
    }

    public function getFiltered(int $cod): array {
        $sql = "SELECT t.idTAX, t.taxName, t.value FROM TAX t WHERE NOT EXISTS (SELECT Tax_idTax FROM TAX_PRODUCT tp WHERE tp.Tax_idTax = t.idTAX AND tp.Product_idProduct = ?) ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $cod);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $finalArray = [];
        foreach ($rows as $index => $column) {
            $cod = $column["idTAX"];
            $nom = $column["taxName"];
            $finalArray[$cod] = $nom;
        }
        return $finalArray;
    }

    public function getOne(tax $obj): tax {
        $cod = $obj->get_idTax();
        $sql = "SELECT t.idTax, t.taxName, t.value ";
        $sql .= "FROM TAX t ";
        $sql .= "WHERE t.idTax = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $cod);
        $resource->execute();
        $row = $resource->fetchAll(PDO::FETCH_ASSOC);

        $obj->set_idTax($row[0]["idTax"]);
        $obj->set_taxName($row[0]["taxName"]);
        return $obj;
    }

    public function addTax(tax $obj): bool {
        $nombre = $obj->get_taxName();
        $val = $obj->get_value();
        $sql = "INSERT INTO TAX(taxName, value) VALUES (?,?) ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $nombre);
        $resource->bindParam(2, $val);
        return $resource->execute();
    }

    public function deleteTax(tax $objeto): bool {
        $id = $objeto->get_idTax();
        $sql = "DELETE FROM TAX WHERE idTax = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $id);
        return $resource->execute();
    }

    public function updateTax(tax $obj): bool {
        $nombre = $obj->get_taxName();
        $cod = $obj->get_idTax();
        $val = $obj->get_value();
        $sql = "UPDATE TAX SET taxName = ?, value = ? WHERE idTax = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $nombre);
        $resource->bindParam(2, $val);
        $resource->bindParam(3, $cod);
        return $resource->execute();
    }

}

?>
