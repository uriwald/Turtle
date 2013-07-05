<?php
    session_start(); //Start session for writing
    session_unset();
    require_once("environment.php");
    if (!isset ($homePage))
      $homePage = "index.php";  
    header("location: " . $homePage);
?>