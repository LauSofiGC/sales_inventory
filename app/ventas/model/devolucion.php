<?php

namespace app\ventas\model;

class devolucion {
    private int $_idDevolution;
    private \DateTime $_dateDevolution;
    private int $_idTicketTaxProd;
    
    function __construct() {
        
    }
    
    function get_idDevolution(): int {
        return $this->_idDevolution;
    }

    function get_dateDevolution(): \DateTime {
        return $this->_dateDevolution;
    }

    function get_idTicketTaxProd(): int {
        return $this->_idTicketTaxProd;
    }

    function set_idDevolution(int $_idDevolution): void {
        $this->_idDevolution = $_idDevolution;
    }

    function set_dateDevolution(\DateTime $_dateDevolution): void {
        $this->_dateDevolution = $_dateDevolution;
    }

    function set_idTicketTaxProd(int $_idTicketTaxProd): void {
        $this->_idTicketTaxProd = $_idTicketTaxProd;
    }

}
