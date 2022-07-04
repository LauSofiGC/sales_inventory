<?php

namespace app\ventas\controller;

use app\ventas\repos\ticketrepo;
use app\ventas\model\ticket;

class ticketcontroller {

    private $_objTicket;

    public function __construct() {
        $this->_objTicket = new ticketrepo();
    }

    public function addTicket(ticket $obj): bool {
        return $this->_objTicket->addTicket($obj);
    }

    public function verificarUltId(): int {
        return $this->_objTicket->verificarUltId();
    }

    public function devDate(int $id): string {
        return $this->_objTicket->devDate($id);
    }
    
    public function eliminarTicket(int $id): bool {
        return $this->_objTicket->eliminarTicket($id);
    }
    
        public function actualizarFac(int $id, int $precioTot, int $subTot, int $imp): bool {
            return$this->_objTicket->actualizarFac($id, $precioTot, $subTot, $imp);
        }

}

?>
