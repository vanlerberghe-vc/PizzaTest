<?php

namespace Pizza\Entities;

class Pizza{
    private static $idMap = array();
    
    private $pizzaId;
    private $naam;
    private $prijs;
    private $samenstelling;
    private $beschikbaarheid;
    
    private function __construct($pizzaId, $naam, $prijs, $samenstelling, $beschikbaarheid) {
        $this->pizzaId = $pizzaId;
        $this->naam = $naam;
        $this->prijs = $prijs;
        $this->samenstelling = $samenstelling;
        $this->beschikbaarheid = $beschikbaarheid;
    }
    
    public static function create($pizzaId, $naam, $prijs, $samenstelling, $beschikbaarheid){
        if(!isset(self::$idMap[$pizzaId])){
            self::$idMap[$pizzaId] = new Pizza($pizzaId, $naam, $prijs, $samenstelling, $beschikbaarheid);
        }
        return self::$idMap[$pizzaId];
    }
    
    public function getPizzaId(){
        return $this->pizzaId;
    }
    
    public function getNaam(){
        return $this->naam;
    }
    
    public function getPrijs(){
        return $this->prijs;
    }
    
    public function getSamenstelling(){
        return $this->samenstelling;
    }
    
    public function getBeschikbaarheid(){
        return $this->beschikbaarheid;
    }
    
    public function setPizzaId($pizzaId){
        $this->pizzaId = $pizzaId;
    }
    
    public function setNaam($naam){
        $this->naam = $naam;
    }
    
    public function setPrijs($prijs){
        $this->prijs = $prijs;
    }
    
    public function setSamenstelling($samenstelling){
        $this->samenstelling = $samenstelling;
    }
    
    public function setBeschikbaarheid($beschikbaarheid){
        $this->beschikbaarheid = $beschikbaarheid;
    }
}
