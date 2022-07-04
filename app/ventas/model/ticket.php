<?php

namespace app\ventas\model;

class ticket {
    private int $_idTicket;
    private string $_ticketDate;
    private int $_idPerson;
    
    public function __construct() {
        
    }
    function get_idTicket(): int {
        return $this->_idTicket;
    }

    function get_ticketDate(): string {
        return $this->_ticketDate;
    }

    function get_idPerson(): int {
        return $this->_idPerson;
    }

    function set_idTicket(int $_idTicket): void {
        $this->_idTicket = $_idTicket;
    }

    function set_ticketDate(string $_ticketDate): void {
        $this->_ticketDate = $_ticketDate;
    }

    function set_idPerson(int $_idPerson): void {
        $this->_idPerson = $_idPerson;
    }


}
