<?php
    session_start(); 
    $locale = "ru_RU";
    $_SESSION['locale'] = "ru_RU";
    require_once("environment.php");
    require_once($home_page);
?>