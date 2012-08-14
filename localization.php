<?php

    $locale = "en_US.utf8";
    if (isSet($_GET["locale"])) 
        $locale = $_GET["locale"].".utf8";
    if (isSet($_GET["ltranslate"])) 
        $locale = $_GET["ltranslate"].".utf8";
    //echo $locale;
    putenv("LC_ALL=$locale");
    setlocale(LC_ALL, $locale);
    //setlocale(LC_ALL, "sp_SP.utf8");
    bindtextdomain("messages", "./locale");
    textdomain("messages");
    
?>
