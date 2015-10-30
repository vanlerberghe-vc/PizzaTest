<?php

use Pizza\Business\KlantService;
use Doctrine\Common\ClassLoader;

require_once ("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

session_start();

if(isset($_COOKIE["email"])){
    $_SESSION["email"] = $_COOKIE["email"];
}else{
    $_SESSION["email"] = "";
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "aanmelden") {
        $ksvc = new KlantService();
        $check = $ksvc->controleerKlant($_POST["txtEmail"], $_POST["txtWachtwoord"]);
        if ($check) {
            $_SESSION["aangemeld"] = true;
            $_SESSION["email"] = $_POST["txtEmail"];
            setcookie("email", $_SESSION["email"], time() + 3600);
            
            //voorlopig? voor gegevens op afrekenen voor zowel geregistreerde als ongeregistreerde klanten
            $klant = $ksvc->haalKlantOp($_SESSION["email"]);
            $_SESSION["naam"] = $klant->getNaam();
            $_SESSION["voornaam"] = $klant->getVoornaam();
            $_SESSION["straat"] = $klant->getStraat();
            $_SESSION["huisnummer"] = $klant->getHuisnummer();
            $_SESSION["postcode"] = $klant->getPostcode();
            $_SESSION["gemeente"] = $klant->getWoonplaats();
            $_SESSION["telefoon"] = $klant->getTelefoon();
            
            header("location:afrekenenController.php");
            exit(0);
        } else {
            header("location:aanmeldenController.php?error=fouteLogin");
            exit(0);
        }
    }
}else{
    $error = "";
}

if(isset($_GET["error"])){
    if($_GET["error"] == "fouteLogin"){
        $error = "fouteLogin";
    }else{
        $error = "";
    }
}





$view = $twig->render("aanmelden.twig", array("error" => $error, "email" => $_SESSION["email"]));
print($view);

