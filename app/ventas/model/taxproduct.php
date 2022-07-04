<?php

namespace app\ventas\model;

class taxproduct {
    private int $_idTaxProduct;
    private int $_idProduct;
    private int $_idTax;
    private string $_dateInit;
    
    public function __construct() {
        
    }
    function get_idTaxProduct(): int {
        return $this->_idTaxProduct;
    }

    function get_idProduct(): int {
        return $this->_idProduct;
    }

    function get_idTax(): int {
        return $this->_idTax;
    }

    function get_dateInit(): string {
        return $this->_dateInit;
    }

    function set_idTaxProduct(int $_idTaxProduct): void {
        $this->_idTaxProduct = $_idTaxProduct;
    }

    function set_idProduct(int $_idProduct): void {
        $this->_idProduct = $_idProduct;
    }

    function set_idTax(int $_idTax): void {
        $this->_idTax = $_idTax;
    }

    function set_dateInit(string $_dateInit): void {
        $this->_dateInit = $_dateInit;
    }


}
