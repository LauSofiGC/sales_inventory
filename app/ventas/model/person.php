<?php

namespace app\ventas\model;

class person{
    private int $_idPerson;
    private string $_docPerson;
    private string $_nombreP;
    private int $_idRole;
    private string $_correo;
    private string $_clave;
    
    public function __construct() {
        
    }
    public function get_idPerson(): int {
        return $this->_idPerson;
    }

    public function get_docPerson(): string {
        return $this->_docPerson;
    }

    public function get_idRole(): int {
        return $this->_idRole;
    }

    public function set_idPerson(int $_idPerson): void {
        $this->_idPerson = $_idPerson;
    }

    public function set_docPerson(string $_docPerson): void {
        $this->_docPerson = $_docPerson;
    }

    public function set_idRole(int $_idRole): void {
        $this->_idRole = $_idRole;
    }
    
    function get_correo() {
        return $this->_correo;
    }

    function get_clave() {
        return $this->_clave;
    }

    function set_correo($_correo): void {
        $this->_correo = $_correo;
    }

    function set_clave($_clave): void {
        $this->_clave = $_clave;
    }
    
    function get_nombreP(): string {
        return $this->_nombreP;
    }

    function set_nombreP(string $_nombreP): void {
        $this->_nombreP = $_nombreP;
    }

}
