<?php
    session_start(); 
    $locale = "zh_CN";
    $_SESSION['locale'] = "zh_CN";
    require_once("environment.php");
    require_once($homePage);
?>