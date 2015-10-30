<?php

namespace Pizza\Business;

use Pizza\Data\BestregDAO;

class BestregService{
    
    public function haalBestregOp($bestellingId){
        $bdao = new BestregDAO();
        $bestreg = $bdao->getByBestelId($bestellingId);
        return $bestreg;
    }
    
    public function voegBestregToe($bestelId, $pizzaId, $aantal, $prijs){
        $bdao = new BestregDAO();
        $bdao->create($bestelId, $pizzaId, $aantal, $prijs);
    }
}

