<?php
    if(session_id() == '') 
        session_start();
    require_once("environment.php");
    $locale       =   "zh_CN";
    require_once("plain.php");
?>
