<?php

namespace Pizza\Business;

use Pizza\Data\KlantDAO;

class KlantService{
    
    public function controleerKlant($email, $wachtwoord){
        $kdao = new KlantDAO();
        $teControlerenKlant = $kdao->getByEmail($email);
        
        if(isset($teControlerenKlant) && $teControlerenKlant->getWachtwoord() == sha1($wachtwoord)){
            return true;
        }else{
            return false;
        }
    }
    
    public function voegKlantToe($naam, $voornaam, $email, $wachtwoord, 
            $straat, $huisnummer, $postcode, $woonplaats, $telefoon){
        $kdao = new KlantDAO();
        /*$teCheckenKlant = $kdao->getByEmail($email);
        if($teCheckenKlant){
            throw new \Pizza\Exceptions\KlantBestaatException();
        }*/
        $kdao->create($naam, $voornaam, $email, sha1($wachtwoord),
                $straat, $huisnummer, $postcode, $woonplaats, $telefoon);
    }
    
    public function haalKlantOp($email){
        $kdao = new KlantDAO();
        $klant = $kdao->getByEmail($email);
        return $klant;
    }
    
    public function controleerPostcode($postcode){
        if($postcode == "2390" || $postcode == "2960" || $postcode == "1000"){
            return true;
        }
        else{
            return false;
        }
    }
}

