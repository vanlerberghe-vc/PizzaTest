<?php

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

if(isset($_SESSION["wijzig"]) && $_SESSION["wijzig"] == true){
    header("location:afrekenenController.php");
    exit(0);
}

$view = $twig->render("checkAccount.twig", array());
print($view);

