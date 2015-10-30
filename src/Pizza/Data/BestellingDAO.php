<?php

namespace Pizza\Data;

use Pizza\Entities\Bestelling;
use Pizza\Entities\Klant;
use Pizza\Data\DBConfig;
use Pizza\Exceptions\FailedQueryException;

use PDO;

class BestellingDAO{
    
    public function getByKlantId($klantId){
        $sql = "select * from bestelling, klant where bestelling.klantId = '".$klantId."'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        if(!$rij){
            $dbh = null;
            return null;
        }else{            
            $klant = Klant::create($rij["klant.klantId"], $rij["naam"], $rij["voornaam"], $rij["email"], $rij["wachtwoord"],
                    $rij["straat"], $rij["huisnummer"], $rij["postcode"], $rij["woonplaats"],
                    $rij["telefoon"], $rij["bemerking"], $rij["promo"]);
            $bestelling = Bestelling::create($rij["bestelId"], $klant, $rij["tijdstip"], $rij["totaalprijs"], $rij["koerierinfo"]);
        }
        $dbh = null;
        return $bestelling;
    }
    
    public function create($klantId, $tijdstip, $totaalprijs, $koerierinfo){
        $sql = "insert into bestelling (klantId, tijdstip, totaalprijs, koerierinfo) values "
                . "('".$klantId."', '".$tijdstip."', '".$totaalprijs."', '".$koerierinfo."')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        
        $dbh = null;
        
    }
}
