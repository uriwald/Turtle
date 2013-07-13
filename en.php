<?php
    session_start(); 
    $locale             = "en_US";
    $_SESSION['locale'] = "en_US";
    require_once("environment.php");
    require_once($lessonPage);
?>