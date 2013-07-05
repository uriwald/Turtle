<?php
    /* 
    $locale = "en_US.utf8";
    if (isSet($_GET["locale"])) 
        $locale = $_GET["locale"].".utf8";
    if (isSet($_GET["ltranslate"])) 
        $locale = $_GET["ltranslate"].".utf8";
     * */
     
    //echo $locale;
    if(session_id() == '') 
        session_start();
    //$locale = "en_us";
    if (isset ($_SESSION["locale"]))
        $locale =   $_SESSION["locale"];
    if (isset ($_GET['l']))
        $locale =   $_GET['l'];
    if (isset ($_GET['locale']))
        $locale =   $_GET['locale'];
    if ( !isset ($locale))
    {
        if (isSet($_GET["ltranslate"])) 
            $localeEnv = $_GET["ltranslate"].".utf8";
        else
            $localeEnv = "en_US.utf8";
    }
     else {
       $localeEnv = $locale.".utf8" ; 
    } 
    //echo " locale env is " . $localeEnv ;
    putenv("LC_ALL=$localeEnv");
    setlocale(LC_ALL, $localeEnv);
    //setlocale(LC_ALL, "sp_SP.utf8");
    bindtextdomain("messages", "./locale");
    textdomain("messages");
    
?>
