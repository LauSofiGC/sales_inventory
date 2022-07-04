<?php 
namespace app\ventas\model;

class role{
private int $_codRole;
private string $_nombreRol; 

public function __contructor(){

}

public function get_codRol(): int {
    return $this->_codRole;
}

public function get_nombreRol(): string {
    return $this->_nombreRol;
}

public function set_codRol(int $_codRole): void {
    $this->_codRole = $_codRole;
}

public function set_nombreRol(string $_nombreRol): void {
    $this->_nombreRol = $_nombreRol;
}

}
?>