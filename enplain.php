<?php
    if(session_id() == '') 
        session_start();
    require_once("environment.php");
    $locale                 =   "en_US";
    require_once("plain.php");
?>
