<?php

namespace Pizza\Business;

use Pizza\Data\BestellingDAO;

class BestellingService{
    
    public function voegBestellingToe($klantId, $tijdstip, $totaalprijs, $koerierinfo){
        $bdao = new BestellingDAO();
        $bdao->create($klantId, $tijdstip, $totaalprijs, $koerierinfo);
    }
    
    public function haalBestellingOp($klantId){
        $bdao = new BestellingDAO();
        $bestelling = $bdao->getByKlantId($klantId);
        return $bestelling;
    }
    
    public function haalTotaalprijs($winkelmandje){
        
    }
}

