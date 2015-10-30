<?php

namespace Pizza\Data;

use Pizza\Entities\Pizza;
use Pizza\Exceptions\FailedQueryException;
use Pizza\Data\DBConfig;
use PDO;

class PizzaDAO{
    
    public function getAll(){
        $lijst = array();
        $sql = "select * from pizza";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);        
        if(!$resultset){
            $dbh = null;
            return null;
        }else{
            foreach($resultset as $rij){
                $pizza = Pizza::create($rij["pizzaId"], $rij["naam"], $rij["prijs"], $rij["samenstelling"], $rij["beschikbaarheid"]);
                array_push($lijst, $pizza);
            }
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById($pizzaId){
        $sql = "select * from pizza where pizzaId = '".$pizzaId."'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        if(!$rij){
            $dbh = null;
            return null;
        }else{            
            $pizza = Pizza::create($rij["pizzaId"], $rij["naam"], $rij["prijs"], $rij["samenstelling"], $rij["beschikbaarheid"]);
        }
        $dbh = null;
        return $pizza;
    }
}

