<?php

    if(session_id() == '') 
        session_start();
    require_once("environment.php");

    $locale                 =   "he_IL";
    require_once("plain.php");
?>
