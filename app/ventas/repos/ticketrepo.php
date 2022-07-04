<?php

namespace app\ventas\repos;

use PDO;
use config\conn;
use app\ventas\model\ticket;

class ticketrepo extends conn {

    public function addTicket(ticket $obj): bool {
        $idPer = $obj->get_idPerson();
        $fecha = $obj->get_ticketDate();
        $sql = "INSERT INTO TICKET(ticketDate, Person_idPerson) VALUES (?,?) ";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $fecha);
        $resource->bindParam(2, $idPer);
        return $resource->execute();
    }

    public function verificarUltId(): int {
        $sql = "SELECT MAX(idTicket) AS id FROM TICKET";
        $resource = $this->_conn->prepare($sql);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);

        $id = 0;
        foreach ($rows as $index => $column) {
            $id = $column["id"];
        }
        return $id;
    }

    public function devDate(int $id): string {
        $sql = "SELECT date_add((SELECT ticketDate FROM TICKET WHERE idTicket = ?), interval 30 day) AS dateDev";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $id);
        $resource->execute();
        $rows = $resource->fetchAll(PDO::FETCH_ASSOC);

        $dateDev = "";
        foreach ($rows as $index => $column) {
            $dateDev = $column["dateDev"];
        }
        return $dateDev;
    }

    public function eliminarTicket(int $id): bool {
        $sql = "DELETE FROM TICKET WHERE idTicket = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $id);
        return $resource->execute();
    }

    public function actualizarFac(int $id, int $precioTot, int $subTot, int $imp): bool {
        $sql = "UPDATE TICKET SET subTotal  = ?, totImpuesto = ?, totalFac = ? WHERE idTicket = ?";
        $resource = $this->_conn->prepare($sql);
        $resource->bindParam(1, $subTot);
        $resource->bindParam(2, $imp);
        $resource->bindParam(3, $precioTot);
        $resource->bindParam(4, $id);
        return $resource->execute();
    }

}

?>
