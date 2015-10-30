<?php

use Pizza\Business\KlantService;
use Pizza\Exceptions\KlantBestaatException;
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
    if ($_GET["action"] == "registreren") {

        if (empty($_SESSION["naam"])) {
            $_SESSION["naam"] = $_POST["txtNaam"];
        }
        if (empty($_SESSION["voornaam"])) {
            $_SESSION["voornaam"] = $_POST["txtVoornaam"];
        }
        if (empty($_SESSION["straat"])) {
            $_SESSION["straat"] = $_POST["txtStraat"];
        }
        if (empty($_SESSION["huisnummer"])) {
            $_SESSION["huisnummer"] = $_POST["txtHuisnummer"];
        }
        if (empty($_SESSION["gemeente"])) {
            $_SESSION["gemeente"] = $_POST["txtGemeente"];
        }
        if (empty($_SESSION["postcode"])) {
            $_SESSION["postcode"] = $_POST["txtPostcode"];
        }
        if (empty($_SESSION["telefoon"])) {
            $_SESSION["telefoon"] = $_POST["txtTelefoon"];
        }

        if (isset($_POST["checkRegistratie"])) {

            $ksvc = new KlantService();
            $check = $ksvc->controleerPostcode($_SESSION["postcode"]);

            if (!$check) {
                unset($_SESSION["postcode"]);
                header("location: registrerenController.php?error=postcode");
                exit(0);
            }

            try {
                $ksvc->voegKlantToe($_SESSION["naam"], $_SESSION["voornaam"], $_POST["txtEmail"], $_POST["txtWachtwoord"], $_SESSION["straat"], $_SESSION["huisnummer"], $_SESSION["postcode"], $_SESSION["gemeente"], $_SESSION["telefoon"]);
                $_SESSION["email"] = $_POST["txtEmail"];
                $_SESSION["aangemeld"] = true;
                header("location:afrekenenController.php");
                exit(0);
            } catch (KlantBestaatException $kbe) {
                header("location:registrerenController.php?error=klantBestaat");
                exit(0);
            }
        }
        //check postcode
        $ksvc = new KlantService();
        $check = $ksvc->controleerPostcode($_SESSION["postcode"]);
        echo ($check);

        if ($check) {
            header("location:afrekenenController.php?action=afrekenen");
            exit(0);
        } else {
            unset($_SESSION["postcode"]);
            header("location: registrerenController.php?error=postcode");
            exit(0);
        }
        //header("refresh:5;url=afrekenenController.php?action=afrekenen");
        //voegt klant nog niet toe
    }
} else if (isset($_GET["error"])) {
    if ($_GET["error"] == "postcode") {
        $errorPostcode = true;
    }else{
        $errorPostcode = false;
        $errorKlantBestaat = false;
    }

    if ($_GET["error"] == "klantBestaat") {
        $errorKlantBestaat = true;
    }else{
        $errorPostcode = false;
        $errorKlantBestaat = false;
    }
} else {
    $_SESSION["naam"] = "";
    $_SESSION["voornaam"] = "";
    $_SESSION["straat"] = "";
    $_SESSION["huisnummer"] = "";
    $_SESSION["gemeente"] = "";
    $_SESSION["postcode"] = "";
    $_SESSION["telefoon"] = "";

    $errorPostcode = false;
    $errorKlantBestaat = false;
}

$view = $twig->render("registreren.twig", array("naam" => $_SESSION["naam"], "voornaam" => $_SESSION["voornaam"],
    "straat" => $_SESSION["straat"], "huisnummer" => $_SESSION["huisnummer"], "gemeente" => $_SESSION["gemeente"],
    "postcode" => $_SESSION["postcode"], "telefoon" => $_SESSION["telefoon"], "errorPostcode" => $errorPostcode, "errorKlantBestaat" => $errorKlantBestaat));
print($view);

