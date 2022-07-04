<?php 
namespace app\ventas\model;

class prodtype {
    private int $idproductType;
    private string $nameProductType;

    public function __construct() {
        
    }
    
    public function getIdproductType(): int {
        return $this->idproductType;
    }

    public function getNameProductType(): string {
        return $this->nameProductType;
    }

    public function setIdproductType(int $idproductType): void {
        $this->idproductType = $idproductType;
    }

    public function setNameProductType(string $nameProductType): void {
        $this->nameProductType = $nameProductType;
    }
}
?>