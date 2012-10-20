<?php
    /*
    $locale = "en_US.utf8";
    if (isSet($_GET["locale"])) 
        $locale = $_GET["locale"].".utf8";
    if (isSet($_GET["ltranslate"])) 
        $locale = $_GET["ltranslate"].".utf8";
     * */
     
    //echo $locale;
    if ( !isset ($locale))
    {
            $localeEnv = "en_US.utf8";
    }
     else {
       $localeEnv = $locale.".utf8" ; 
    }
    putenv("LC_ALL=$localeEnv");
    setlocale(LC_ALL, $localeEnv);
    //setlocale(LC_ALL, "sp_SP.utf8");
    bindtextdomain("messages", "./locale");
    textdomain("messages");
    
?>
