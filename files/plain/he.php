<?php
    if(session_id() == '') 
        session_start();
    require_once("../../environment.php");

    $locale     =   "he_IL";
    $_SESSION["locale"] =  $locale; 
    require_once("../../plain.php");
?>
