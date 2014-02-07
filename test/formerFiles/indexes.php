<?php
    session_start(); 
    $locale = "es_AR";
    $_SESSION['locale'] = "es_AR";
    require_once("environment.php");
    require_once($home_page);
?>