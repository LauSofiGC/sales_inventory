<?php

namespace app\ventas\model;

class tickettaxproduct {
    private int $_idTicketTaxProduct;
    private \DateTime $_dateTicketTaxProductDevolution;
    private int $_idTaxProduct;
    private int $_idTicket;
    
    public function __construct() {
        
    }
    
    function get_idTicketTaxProduct(): int {
        return $this->_idTicketTaxProduct;
    }

    function get_dateTicketTaxProductDevolution(): \DateTime {
        return $this->_dateTicketTaxProductDevolution;
    }

    function get_idTaxProduct(): int {
        return $this->_idTaxProduct;
    }

    function get_idTicket(): int {
        return $this->_idTicket;
    }

    function set_idTicketTaxProduct(int $_idTicketTaxProduct): void {
        $this->_idTicketTaxProduct = $_idTicketTaxProduct;
    }

    function set_dateTicketTaxProductDevolution(\DateTime $_dateTicketTaxProductDevolution): void {
        $this->_dateTicketTaxProductDevolution = $_dateTicketTaxProductDevolution;
    }

    function set_idTaxProduct(int $_idTaxProduct): void {
        $this->_idTaxProduct = $_idTaxProduct;
    }

    function set_idTicket(int $_idTicket): void {
        $this->_idTicket = $_idTicket;
    }
}
