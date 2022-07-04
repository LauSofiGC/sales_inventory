<?php

namespace app\ventas\controller;

use app\ventas\repos\loginrepository;
use app\ventas\model\person;

class loginfacade {
    private $_objLoginDB;

    public function __construct() {
        $this->_objLoginDB = new loginrepository();
    }

    public function isValidatePerson(person $obj): int {
        return $this->_objLoginDB->isValidatePerson($obj);
    }

    public function getProfiles(person $obj): array {
        return $this->_objLoginDB->getProfiles($obj);
    }
}
