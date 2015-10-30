<?php

/* andere uses */

use Pizza\Business\PizzaService;
use Doctrine\Common\ClassLoader;

require_once ("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

session_start();

if (!(isset($_SESSION["winkelmandje"]))) {
    $_SESSION["winkelmandje"] = array();
    $_SESSION["totaalprijs"] = 0;
}

//$winkelmandje = array();

$psvc = new PizzaService();
$pizzaLijst = $psvc->haalPizzaOverzicht();

if (isset($_GET["keuze"])) {
    $gekozenPizzaId = $_GET["keuze"];
    $gekozenPizza = $psvc->haalPizza($gekozenPizzaId);
    $_SESSION["totaalprijs"] += $gekozenPizza->getPrijs();
    $_SESSION["winkelmandje"] = $psvc->vulWinkelmandje($gekozenPizza, $_SESSION["winkelmandje"]);
    //$item = $psvc->vulWinkelmandje($gekozenPizza);    
    header("location:aanbodController.php");
    exit(0);
} else if (isset($_GET["action"])) {
    if ($_GET["action"] == "verwijderItem") {
        $teVerwijderenPizzaId = $_GET["item"];
        $teVerwijderenPizza = $psvc->haalPizza($teVerwijderenPizzaId);
        $_SESSION["totaalprijs"] -= $teVerwijderenPizza->getPrijs();
        //$_SESSION["winkelmandje"] = $psvc->verwijderWinkelmandje($teVerwijderenPizza, $_SESSION["winkelmandje"]);
        
         $key=array_search($teVerwijderenPizza, $_SESSION["winkelmandje"]);
          if($key!==false){
          unset($_SESSION["winkelmandje"][$key]);
          }
          $_SESSION["winkelmandje"] = array_values($_SESSION["winkelmandje"]); 
    }
    if ($_GET["action"] == "afrekenen") {
        if (!empty($_SESSION["winkelmandje"])) {
            if (isset($_SESSION["aangemeld"])) {
                header("location:afrekenenController.php");
                exit(0);
            } else {
                header("location:checkAccountController.php");
                exit(0);
            }
        }else{
            header("location:aanbodController.php");
        }
    }
    if($_GET["action"] == "wijzig"){
        $_SESSION["wijzig"] = true;
    }
} else {
    $gekozenPizzaId = "";
    $gekozenPizza = "";

    $keuzeGemaakt = false;
}

$view = $twig->render("aanbod.twig", array("pizzaLijst" => $pizzaLijst,
    "winkelmandje" => $_SESSION["winkelmandje"], "totaalprijs" => $_SESSION["totaalprijs"]));
print($view);

