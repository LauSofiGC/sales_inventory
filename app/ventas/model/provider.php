<?php

namespace app\ventas\model;

class provider {
    private int $_idProvider;
    private string $_phoneNumber;
    private string $_providerName;
    
    public function __construct() {
        
    }
    
    public function get_idProvider(): int {
        return $this->_idProvider;
    }

    public function get_phoneNumber(): string {
        return $this->_phoneNumber;
    }

    public function get_providerName(): string {
        return $this->_providerName;
    }

    public function set_idProvider(int $_idProvider): void {
        $this->_idProvider = $_idProvider;
    }

    public function set_phoneNumber(string $_phoneNumber): void {
        $this->_phoneNumber = $_phoneNumber;
    }

    public function set_providerName(string $_providerName): void {
        $this->_providerName = $_providerName;
    }
}
