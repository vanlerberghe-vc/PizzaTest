<?php

namespace Pizza\Data;

use Pizza\Entities\Klant;
use Pizza\Exceptions\FailedQueryException;
use Pizza\Exceptions\KlantBestaatException;
use Pizza\Data\DBConfig;
use PDO;

class KlantDAO{
    
    public function getByEmail($email){
        
        $sql = "select * from klant where email = '".$email."'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        if(!$rij){
            $dbh = null;
            return null;
        }else{            
            $klant = Klant::create($rij["klantId"], $rij["naam"], $rij["voornaam"], $rij["email"], $rij["wachtwoord"], $rij["straat"], $rij["huisnummer"], $rij["postcode"], $rij["woonplaats"], $rij["telefoon"], $rij["bemerking"], $rij["promo"]);
            $dbh = null;
            return $klant;
        }     
        
    }
    
    public function create($naam, $voornaam, $email, $wachtwoord, 
            $straat, $huisnummer, $postcode, $woonplaats, $telefoon){
        echo("tot hier toch al wel ja");
        $bestaandeKlant = $this->getByEmail($email);
                
        if(isset($bestaandeKlant)){            
            throw new KlantBestaatException();
        }
        echo("niet tot hier?");
        $sql = "insert into klant (naam, voornaam, email, wachtwoord, straat, huisnummer, postcode, woonplaats, telefoon)"
                . "values ('".$naam."','".$voornaam."','".$email."','".$wachtwoord."','".$straat."','".$huisnummer."','".$postcode."','".$woonplaats."','".$telefoon."')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        
        $dbh = null;
    }
}
