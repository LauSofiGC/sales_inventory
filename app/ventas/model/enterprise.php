<?php 
namespace app\ventas\model; 

class enterprise{
    private int $idEnterprise;
    private string $enterpriseName;
    private string $address;
    private string $phoneNumber;
    
    public function __construct() {
        
    }

    public function getIdEnterprise(): int {
        return $this->idEnterprise;
    }

    public function getEnterpriseName(): string {
        return $this->enterpriseName;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function setIdEnterprise(int $idEnterprise): void {
        $this->idEnterprise = $idEnterprise;
    }

    public function setEnterpriseName(string $enterpriseName): void {
        $this->enterpriseName = $enterpriseName;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function setPhoneNumber(string $phoneNumber): void {
        $this->phoneNumber = $phoneNumber;
    }
}
?>