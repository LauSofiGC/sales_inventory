<?php

namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\provider;

class proveedorrepo extends conn {

    public function getAll(): array {
        $sql = "SELECT p.idProvider, p.phoneNumber, p.providerName ";
        $sql .= "FROM PROVIDER p ";
        $sql .= "ORDER BY p.idProvider ASC ";

        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function addPerson(provider $objeto): bool {
        $phoneNumb = $objeto->get_phoneNumber();
        $provName = $objeto->get_providerName();
        $sql = "INSERT INTO PROVIDER(phoneNumber, providerName) VALUES (?,?) ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $phoneNumb);
        $resource->bindParam(2, $provName);
        return $resource->execute();
    }
    
     public function getAllDropDown(): array {
        $sql = "SELECT p.idProvider, p.providerName, p.phoneNumber FROM PROVIDER p ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $finalArray = [];
        foreach ($rows as $index => $column) {
            $cod = $column["idProvider"];
            $nom = $column["providerName"];
            $finalArray[$cod] = $nom;
        }
        return $finalArray;
    }
    

}

?>
