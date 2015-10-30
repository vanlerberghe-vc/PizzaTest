<?php

use Pizza\Business\PizzaService;
use Pizza\Business\KlantService;
use Pizza\Business\BestellingService;
use Pizza\Business\BestregService;
use Doctrine\Common\ClassLoader;

require_once ("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

session_start();

/* if (isset($_SESSION["aangemeld"]) || isset($_GET["action"])) {
  if ($_SESSION["aangemeld"] == true) {
  if (isset($_GET["action"])) {
  if ($_GET["action"] == "bestel") {
  //bijna helemaal fout denk ik...
  $ksvc = new KlantService();
  $klant = $ksvc->haalKlantOp($_SESSION["email"]);
  $bsvc = new BestellingService();
  $tijdstip = Date("F j, Y, g:i a");
  $totaalprijs = $_SESSION["totaalprijs"];
  $bsvc->voegBestellingToe($klant->getKlantId(), $tijdstip, $totaalprijs, $_POST["koerierinfo"]);

  /* $bestellingId = $bsvc->haalBestellingOp($klant->getKlantId());
  $bsvc = new BestregService();
  foreach($_SESSION["winkelmandje"] as $bestreg){
  //nog niet juist, het aantal van elke pizza moet anders
  $bsvc->voegBestregToe($bestellingId, $bestreg->getNaam(), count($_SESSION["winkelmandje"]), $bestreg->getPrijs());
  } */

/* Na alles afgehandeld is */
/* unset($_SESSION["aangemeld"]);
  unset($_SESSION["winkelmandje"]);
  header("location:aanbodController.php");
  exit(0);
  }
  }
  }

  } else {
  header("location:checkAccountController.php");
  exit(0);
  } */

if (isset($_GET["action"])) {
    if ($_GET["action"] == "afrekenen") {
        
    }
    if ($_GET["action"] == "bestel") {
        $tijdstip = date("Y-m-d H:i:s");
        $totaalprijs = $_SESSION["totaalprijs"];
        /* Voeg bestelling en bestregs toe */
        if ($_SESSION["aangemeld"] == true) { //voor klanten uit DB
            $ksvc = new KlantService();
            $klant = $ksvc->haalKlantOp($_SESSION["email"]);
            $bsvc = new BestellingService();
            $bsvc->voegBestellingToe($klant->getKlantId(), $tijdstip, $totaalprijs, $_POST["koerierinfo"]);
        } else { //voor niet geregistreerde klanten
            $bsvc = new BestellingService();
            $klantId = null;
            $bsvc->voegBestellingToe($klantId, $tijdstip, $totaalprijs, $_POST["koerierinfo"]);
        }

        unset($_SESSION["aangemeld"]);
        unset($_SESSION["winkelmandje"]);
        unset($_SESSION["naam"]);
        unset($_SESSION["voornaam"]);
        unset($_SESSION["straat"]);
        unset($_SESSION["postcode"]);
        unset($_SESSION["gemeente"]);
        unset($_SESSION["telefoon"]);
        unset($_SESSION["email"]);
        unset($_SESSION["wijzig"]);
        header("location:aanbodController.php");
        exit(0);
    }
}

$view = $twig->render("afrekenen.twig", array("winkelmandje" => $_SESSION["winkelmandje"], "totaalprijs" => $_SESSION["totaalprijs"],
    "naam" => $_SESSION["naam"], "voornaam" => $_SESSION["voornaam"], "straat" => $_SESSION["straat"], "huisnummer" => $_SESSION["huisnummer"],
    "postcode" => $_SESSION["postcode"], "gemeente" => $_SESSION["gemeente"], "telefoon" => $_SESSION["telefoon"]));
print($view);
