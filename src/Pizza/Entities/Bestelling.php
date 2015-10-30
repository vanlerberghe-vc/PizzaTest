<?php

namespace Pizza\Entities;

class Bestelling{
    private static $idMap = array();
    
    private $bestelId;
    private $klant;
    private $tijdstip;
    private $totaalprijs;
    private $koerierinfo;
    
    private function __construct($bestelId, $klant, $tijdstip, $totaalprijs, $koerierinfo) {
        $this->bestelId = $bestelId;
        $this->klant = $klant;
        $this->tijdstip = $tijdstip;
        $this->totaalprijs =$totaalprijs;
        $this->koerierinfo = $koerierinfo;
    }
    
    public static function create($bestelId, $klant, $tijdstip, $totaalprijs, $koerierinfo){
        if(!isset(self::$idMap[$bestelId])){
            self::$idMap[$bestelId] = new Bestelling($bestelId, $klant, $tijdstip, $totaalprijs, $koerierinfo);
        }
        return self::$idMap[$bestelId];
    }
    
    public function getBestelId(){
        return $this->bestelId;
    }
    
    public function getKlant(){
        return $this->klant;
    }
    
    public function getTijdstip(){
        return $this->tijdstip;
    }
    
    public function getTotaalprijs(){
        return $this->totaalprijs;
    }
    
    public function getKoerierinfo(){
        return $this->koerierinfo;
    }
    
    public function setBestelId($bestelId){
        $this->bestelId = $bestelId;
    }
    
    public function setKlant($klant){
        $this->klant = $klant;
    }
    
    public function setTijdstip($tijdstip){
        $this->tijdstip = $tijdstip;
    }
    
    public function setTotaalprijs($totaalprijs){
        $this->totaalprijs = $totaalprijs;
    }
    
    public function setKoerierinfo($koerierinfo){
        $this->koerierinfo = $koerierinfo;
    }
}
