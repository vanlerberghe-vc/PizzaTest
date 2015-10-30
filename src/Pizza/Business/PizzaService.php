<?php

namespace Pizza\Business;

use Pizza\Data\PizzaDAO;

class PizzaService{
    
    public function haalPizzaOverzicht(){
        $pdao = new PizzaDAO();
        $lijst = $pdao->getAll();
        return $lijst;
    }
    
    public function haalPizza($pizzaId){
        $pdao = new PizzaDAO();
        $pizza = $pdao->getById($pizzaId);
        return $pizza;
    }
    
    public function vulWinkelmandje($pizza, $mandje){
        array_push($mandje, $pizza);
        return $mandje;
    }
    
    public function verwijderWinkelmandje($pizza, $mandje){
        echo 'test';
        $key = array_search($pizza, $mandje);
        if($key!==false){
            unset($mandje,$key);
        }
        $mandje = array_values($mandje);
        return $mandje;
    }
}

