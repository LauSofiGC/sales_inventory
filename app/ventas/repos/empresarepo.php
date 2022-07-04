<?php

namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\enterprise;

class empresarepo extends conn {

    public function getAllDropDown(): array {
        $sql = "SELECT e.idEnterprise, e.enterpriseName, e.address, e.phoneNumber FROM ENTERPRISE e ";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);
        $finalArray = [];
        foreach ($rows as $index => $column) {
            $cod = $column["idEnterprise"];
            $nom = $column["enterpriseName"];
            $add = $column["address"];
            $phNum = $column["phoneNumber"];
            $finalArray[$cod] = $nom . " ". $add. " ". $phNum;
        }
        return $finalArray;
    }

}

?>
