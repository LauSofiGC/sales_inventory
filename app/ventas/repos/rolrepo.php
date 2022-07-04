<?php 
namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\role;

class rolrepo extends conn{
    public function getAllRol(): array {
        $sql = "SELECT r.idRole, r.roleName, ";
        $sql .="(SELECT COUNT(Role_idRole) FROM PERSON WHERE Role_idRole = r.idRole) AS cantidad ";
        $sql .= "FROM ROLE r ";
        $sql .= "ORDER BY r.idRole DESC ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    
        public function getAllDropDown(): array {
        $sql = "SELECT r.idRole, r.roleName FROM ROLE r ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $finalArray = [];
        foreach ($rows as $index => $column) {
            $cod = $column["idRole"];
            $nom = $column["roleName"];
            $finalArray[$cod] = $nom;
        }
        return $finalArray;
    }

    public function getOne(role $obj): role{
        $cod = $obj->get_codRol();
        $sql = "SELECT r.idRole, r.roleName ";
        $sql .= "FROM ROLE r ";
        $sql .= "WHERE r.idRole = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $cod);
        $resource->execute();
        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        
         $obj->set_codRol($row[0]["idRole"]);
         $obj->set_nombreRol($row[0]["roleName"]);
        return $obj;
    }
    
    public function addRol(role $obj):bool{
        $nombre = $obj->get_nombreRol();
        $sql = "INSERT INTO ROLE(roleName) VALUES (?) ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $nombre);
        return $resource->execute();
    }
    
     public function deleteRol(role $objeto): bool {
        $id = $objeto->get_codRol();
        $sql = "DELETE FROM ROLE WHERE idRole = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $id);
        return $resource->execute();
     }
     
         public function updateRol(role $obj): bool {
        $nombre = $obj->get_nombreRol();
        $cod=$obj->get_codRol();
        $sql = "UPDATE ROLE SET roleName = ? WHERE idRole = ? ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $nombre);
        $resource->bindParam(2, $cod);
        return $resource->execute();
    }  
}
?>
