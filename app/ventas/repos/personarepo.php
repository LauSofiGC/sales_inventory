<?php

namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\person;

class personarepo extends conn {

    public function getAll(): array {
        $sql = "SELECT p.idPerson, p.documentPerson, "
                . "(SELECT roleName FROM ROLE WHERE idRole=p.Role_idRole) AS nomRol, p.name ";
        $sql .= "FROM PERSON p INNER JOIN ROLE r ON r.idRole=p.Role_idRole ";
        $sql .= "ORDER BY p.idPerson DESC ";

        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function addPerson(person $objeto): bool {
        $docPersona = $objeto->get_docPerson();
        $codRol = $objeto->get_idRole();
        $em = $objeto->get_correo();
        $clave = $objeto->get_clave();
        $nom = $objeto->get_nombreP();
        $sql = "INSERT INTO PERSON(documentPerson, Role_idRole, correo, clave, name) VALUES (?,?,?,?,?) ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $docPersona);
        $resource->bindParam(2, $codRol);
        $resource->bindParam(3, $em);
        $resource->bindParam(4, $clave);
        $resource->bindParam(5, $nom);
        return $resource->execute();
    }
    
        public function addClient(person $objeto): bool {
        $docPersona = $objeto->get_docPerson();
        $codRol = $objeto->get_idRole();
        $nom = $objeto->get_nombreP();
        $sql = "INSERT INTO PERSON(documentPerson, Role_idRole, name) VALUES (?,?,?) ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $docPersona);
        $resource->bindParam(2, $codRol);
        $resource->bindParam(3, $nom);
        return $resource->execute();
    }

    public function getAllDropDown(): array {
        $sql = "SELECT p.idPerson, p.name, p.documentPerson "
                . "FROM PERSON p WHERE Role_idRole = 3";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $finalArray = [];
        foreach ($rows as $index => $column) {
            $cod = $column["idPerson"];
            $doc = $column["documentPerson"];
            $nom = $column["name"];
            $finalArray[$cod] = $nom." (".$doc.")";
        }
        return $finalArray;
    }

}

?>
