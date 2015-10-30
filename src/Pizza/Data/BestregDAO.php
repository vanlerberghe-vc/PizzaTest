<?php

namespace Pizza\Data;

use Pizza\Entities\Bestreg;
use Pizza\Entities\Bestelling;
use Pizza\Entities\Pizza;
use Pizza\Entities\Klant;
use Pizza\Data\DBConfig;
use Pizza\Exceptions\FailedQueryException;

use PDO;

class BestregDAO{
    
    public function getByBestelId($bestelId){
        $sql = "select * from bestreg, bestelling, pizza, klant where bestreg.bestelId = '".$bestelId."' "
                . "and bestreg.pizzaId = pizza.pizzaId and bestelling.klantId = klant.klantId";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        if(!$rij){
            $dbh = null;
            return null;
        }else{           
           $klant = Klant::create($rij["klant.klantId"], $rij["klant.naam"], $rij["voornaam"], $rij["email"], $rij["wachtwoord"], 
                   $rij["straat"], $rij["huisnummer"], $rij["postcode"], $rij["woonplaats"], $rij["telefoon"], $rij["bemerking"], $rij["promo"]);
           $bestelling = Bestelling::create($rij["bestelling.bestelId"], $klant, $rij["tijdstip"], $rij["totaalprijs"], $rij["koerierinfo"]);
           $pizza = Pizza::create($rij["pizza.pizzaId"], $rij["pizza.naam"], $rij["pizza.prijs"], $rij["samenstelling"], $rij["beschikbaarheid"]);
           $bestreg = Bestreg::create($rij["bestregId"], $bestelling, $pizza, $rij["aantaal"], $rij["bestreg.prijs"]);
        }
        $dbh = null;
        return $bestreg;
    }
    
    public function create($bestelId, $pizzaId, $aantal, $prijs){
        $sql = "insert into bestreg (bestelId, pizzaId, aantal, prijs) "
                . "values ('".$bestelId."', '".$pizzaId."','".$aantal."','".$prijs."')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        
        $dbh = null;
    }
}

