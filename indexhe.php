<?php
    session_start(); 
    $locale = "he_IL";
    $_SESSION['locale'] = "he_IL";
    require_once("environment.php");
    require_once($homePage);
?>