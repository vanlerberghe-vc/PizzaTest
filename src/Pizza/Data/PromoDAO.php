<?php

namespace Pizza\Data;

use Pizza\Entities\Promo;
use Pizza\Entities\Pizza;
use Pizza\Exceptions\FailedQueryException;
use Pizza\Data\DBConfig;

use PDO;

class PromoDAO{
    
    public function getByPizzaId($pizzaId){
        $sql = "select * from promo, pizza where promo.pizzaId = '".$pizzaId."'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        if(!$rij){
            $dbh = null;
            return null;
        }else{            
            $pizza = Pizza::create($rij["pizza.pizzaId"], $rij["naam"], $rij["prijs"], $rij["samenstelling"], $rij["beschikbaarheid"]);
            $promo = Promo::create($rij["promoId"], $pizza, $rij["promoprijs"]);
        }
        $dbh = null;
        return $promo;
    }        
}

