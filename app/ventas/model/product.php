<?php

namespace app\ventas\model;

class product {
    private int $_idProduct;
    private string $_nameProduct;
    private int $_productState;
    private int $_idProvider;
    private int $_idEnterprise;
    private int $_idProductType;
    private int $_precioBruto;
    private int $_quantity;
    
    public function __construct() {
        
    }
    function get_idProduct(): int {
        return $this->_idProduct;
    }

    function get_nameProduct(): string {
        return $this->_nameProduct;
    }

    function get_productState(): int {
        return $this->_productState;
    }

    function get_idProvider(): int {
        return $this->_idProvider;
    }

    function get_idEnterprise(): int {
        return $this->_idEnterprise;
    }

    function get_idProductType(): int {
        return $this->_idProductType;
    }

    function get_precioBruto(): int {
        return $this->_precioBruto;
    }

    function set_idProduct(int $_idProduct): void {
        $this->_idProduct = $_idProduct;
    }

    function set_nameProduct(string $_nameProduct): void {
        $this->_nameProduct = $_nameProduct;
    }

    function set_productState(int $_productState): void {
        $this->_productState = $_productState;
    }

    function set_idProvider(int $_idProvider): void {
        $this->_idProvider = $_idProvider;
    }

    function set_idEnterprise(int $_idEnterprise): void {
        $this->_idEnterprise = $_idEnterprise;
    }

    function set_idProductType(int $_idProductType): void {
        $this->_idProductType = $_idProductType;
    }

    function set_precioBruto(int $_precioBruto): void {
        $this->_precioBruto = $_precioBruto;
    }
    
    function get_quantity(): int {
        return $this->_quantity;
    }

    function set_quantity(int $_quantity): void {
        $this->_quantity = $_quantity;
    }

}
