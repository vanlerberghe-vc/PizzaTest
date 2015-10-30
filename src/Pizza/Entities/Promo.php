<?php

namespace Pizza\Entities;

class Promo{
    private static $idMap = array();
    
    private $promoId;
    private $pizza;
    private $promoprijs;
    
    private function __construct($promoId, $pizza, $promoprijs) {
        $this->promoId = $promoId;
        $this->pizza = $pizza;
        $this->promoprijs = $promoprijs;
    }
    
    public static function create($promoId, $pizza, $promoprijs){
        if(!isset(self::$idMap[$promoId])){
            self::$idMap[$promoId] = new Promo($promoId, $pizza, $promoprijs);
        }
        return self::$idMap[$promoId];
    }
    
    public function getPromoId(){
        return $this->promoId;
    }
    
    public function getPizza(){
        return $this->pizza;
    }
    
    public function getPromoprijs(){
        return $this->promoprijs;
    }
    
    public function setPromoId($promoId){
        $this->promoId = $promoId;
    }
    
    public function setPizza($pizza){
        $this->pizza = $pizza;
    }
    
    public function setPromoprijs($promoprijs){
        $this->promoprijs = $promoprijs;
    }
}

