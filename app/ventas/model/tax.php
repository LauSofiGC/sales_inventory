<?php 
namespace app\ventas\model; 

class tax{
private int $_idTax;
private string $_taxName;
private int $_value;

public function __construct() {
        
}

public function get_idTax(): int {
    return $this->_idTax;
}

public function get_taxName(): string {
    return $this->_taxName;
}

public function set_idTax(int $_idTax): void {
    $this->_idTax = $_idTax;
}

public function set_taxName(string $_taxName): void {
    $this->_taxName = $_taxName;
}

function get_value(): int {
    return $this->_value;
}

function set_value(int $_value): void {
    $this->_value = $_value;
}
}
?>