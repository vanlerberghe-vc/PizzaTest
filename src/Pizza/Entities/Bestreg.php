<?php

namespace Pizza\Entities;

class Bestreg{
    private static $idMap = array();
    
    private $bestregId;
    private $bestelling;
    private $pizza;
    private $aantal;
    private $prijs;
    
    private function __construct($bestregId, $bestelling, $pizza, $aantal, $prijs) {
        $this->bestregId = $bestregId;
        $this->bestelling = $bestelling;
        $this->pizza = $pizza;
        $this->aantal = $aantal;
        $this->prijs = $prijs;
    }
    
    public static function create($bestregId, $bestelling, $pizza, $aantal, $prijs){
        if(!isset(self::$idMap[$bestregId])){
            self::$idMap[$bestregId] = new Bestreg($bestregId, $bestelling, $pizza, $aantal, $prijs);
        }
        return self::$idMap[$bestregId];
    }
    
    public function getBestregId(){
        return $this->bestregId;
    }
    
    public function getBestelling(){
        return $this->bestelling;
    }
    
    public function getPizza(){
        return $this->pizza;
    }
    
    public function getAantal(){
        return $this->aantal;
    }
    
    public function getPrijs(){
        return $this->prijs;
    }
    
    public function setBestregId($bestregId){
        $this->bestregId = $bestregId;
    }
    
    public function setBestelling($bestelling){
        $this->bestelling = $bestelling;
    }
    
    public function setPizza($pizza){
        $this->pizza = $pizza;
    }
    
    public function setAantal($aantal){
        $this->aantal = $aantal;
    }
    
    public function setPrijs($prijs){
        $this->prijs = $prijs;
    }
    
    
}

