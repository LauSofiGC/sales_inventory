<?php

namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\person;

class loginrepository extends conn{
        public function isValidatePerson(person $obj): int {
        $correo = $obj->get_correo();
        $clave = $obj->get_clave();
        $sql = "SELECT p.idPerson, COUNT(p.idPerson) AS cantidadCodPer ";
        $sql .= "FROM PERSON p ";
        $sql .= "WHERE p.correo = ? AND p.clave = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $correo);
        $resource->bindParam(2, $clave);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        $cantidad = $row[0]["cantidadCodPer"];

        if ($cantidad == 1) {
            return $row[0]["idPerson"];
        } else {
            return 0;
        }
    }
    
        public function getProfiles(person $obj): array {
        $codEst = $obj->get_idPerson();

        $sql = "SELECT Role_idRole FROM PERSON ";
        $sql .= "WHERE idPerson = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $codEst);
        $resource->execute();

        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);

        $newArr = [];
        foreach ($rows as $index => $column) {
            $newArr[] = $column["Role_idRole"];
        }
        return $newArr;
    }
    
}
