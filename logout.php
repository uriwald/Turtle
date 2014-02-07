<?php
    session_start(); //Start session for writing
    session_unset();
    require_once("environment.php");
    if (!isset ($home_page))
      $home_page = "index.php";  
    header("location: " . $home_page);
?>