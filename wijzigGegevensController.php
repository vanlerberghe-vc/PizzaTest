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

if (isset($_GET["action"])) {
    if ($_GET["action"] == "wijzig") {
        
    }
    if($_GET["action"] == "bevestigWijzig"){
             
        $_SESSION["naam"] = $_POST["txtNaam"];
        $_SESSION["voornaam"] = $_POST["txtVoornaam"];
        $_SESSION["straat"] = $_POST["txtStraat"];
        $_SESSION["huisnummer"] = $_POST["txtHuisnummer"];
        $_SESSION["gemeente"] = $_POST["txtGemeente"];
        $_SESSION["postcode"] = $_POST["txtPostcode"];
        $_SESSION["telefoon"] = $_POST["txtTelefoon"];
        
        $ksvc = new KlantService();
        $checkPostcode = $ksvc->controleerPostcode($_SESSION["postcode"]);
        
        if($checkPostcode){
            header("location:afrekenenController.php");
            exit(0);
        }else{
            unset($_SESSION["postcode"]);
            header("location:wijzigGegevensController.php?error=postcode");
            exit(0);
        }
        
    }
}

else if(isset($_GET["error"])){
    if($_GET["error"] == "postcode"){
        $errorPostcode = true;
    }
}
else{
    $errorPostcode = false;
}

$view = $twig->render("wijzigGegevens.twig", array("naam" => $_SESSION["naam"], "voornaam" => $_SESSION["voornaam"], "straat" => $_SESSION["straat"], "huisnummer" => $_SESSION["huisnummer"],
    "postcode" => $_SESSION["postcode"], "gemeente" => $_SESSION["gemeente"], "telefoon" => $_SESSION["telefoon"], "errorPostcode" => $errorPostcode));
print($view);

