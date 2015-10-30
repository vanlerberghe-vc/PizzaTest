<?php

namespace Pizza\Entities;

class Klant{
    private static $idMap = array();
    
    private $klantId;
    private $naam;
    private $voornaam;
    private $email;
    private $wachtwoord;
    private $straat;
    private $huisnummer;
    private $postcode;
    private $woonplaats;
    private $telefoon;
    private $bemerking;
    private $promo;
    
    private function __construct($klantId, $naam, $voornaam, $email, $wachtwoord, 
            $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $bemerking, $promo) {
        $this->klantId = $klantId;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->email = $email;
        $this->wachtwoord = $wachtwoord;
        $this->straat = $straat;
        $this->huisnummer = $huisnummer;
        $this->postcode = $postcode;
        $this->woonplaats = $woonplaats;
        $this->telefoon = $telefoon;
        $this->bemerking = $bemerking;
        $this->promo = $promo;       
    }
    
    public static function create($klantId, $naam, $voornaam, $email, $wachtwoord, 
            $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $bemerking, $promo){
        if(!isset(self::$idMap[$klantId])){
            self::$idMap[$klantId] = new Klant($klantId, $naam, $voornaam, $email, $wachtwoord, 
                    $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $bemerking, $promo);
        }
        return self::$idMap[$klantId];
    }
    
    public function getKlantId(){
        return $this->klantId;
    }
    
    public function getNaam(){
        return $this->naam;
    }
    
    public function getVoornaam(){
        return $this->voornaam;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getWachtwoord(){
        return $this->wachtwoord;
    }
    
    public function getStraat(){
        return $this->straat;
    }
    
    public function getHuisnummer(){
        return $this->huisnummer;
    }
    
    public function getPostcode(){
        return $this->postcode;
    }
    
    public function getWoonplaats(){
        return $this->woonplaats;
    }
    
    public function getTelefoon(){
        return $this->telefoon;
    }
    
    public function getBemerking(){
        return $this->bemerking;
    }
    
    public function getPromo(){
        return $this->promo;
    }
    
    public function setKlantId($klantId){
        $this->klantId = $klantId;
    }
    
    public function setNaam($naam){
        $this->naam = $naam;
    }
    
    public function setVoornaam($voornaam){
        $this->voornaam = $voornaam;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setWachtwoord($wachtwoord){
        $this->wachtwoord = $wachtwoord;
    }
    
    public function setStraat($straat){
        $this->straat = $straat;
    }
    
    public function setHuisnummer($huisnummer){
        $this->huisnummer = $huisnummer;
    }
    
    public function setPostcode($postcode){
        $this->postcode = $postcode;
    }
    
    public function setWoonplaats($woonplaats){
        $this->woonplaats = $woonplaats;
    }
    
    public function setTelefoon($telefoon){
        $this->telefoon = $telefoon;
    }
    
    public function setBemerking($bemerking){
       $this->bemerking = $bemerking;
    }
    
    public function setPromo($promo){
        $this->promo = $promo;
    }
    
    
}

