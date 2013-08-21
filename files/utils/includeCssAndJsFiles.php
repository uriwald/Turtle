<?php

/* Including all .js and .css files for each webpage */
require_once("environment.php");

    /* Load JQuery files */
        if ($env== "local"){ 
            echo "<script type='application/javascript' src='/files/dd/js/jquery/jquery-1.8.2.min.js' ></script>";
        }else{
            echo "<script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>";
        }
        if ($env == "local")
            echo "<script type='application/javascript' src='/ajax/libs/jqueryui/1.10.0/js/jquery-ui-1.10.0.custom.js' ></script>";
        else
            echo "<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js'></script>";
        echo "<script type='application/javascript' src='/alerts/jquery.alerts.js' ></script>";
        echo "<script type='application/javascript' src='/files/jquery.tmpl.js' ></script>";
        echo "<script type='application/javascript' src='/files/jquery.Storage.js' ></script>";
        echo "<link   href='/alerts/jquery.alerts.css' rel='stylesheet' >";
        echo "<link   href='/ajax/libs/jqueryui/1.10.0//css/ui-lightness/jquery-ui-1.10.0.custom.css' rel='stylesheet' >";
    /* End load Jquery files */
    
    /* Starat DropDown files */
        
        echo "<script type='application/javascript' src='/files/dd/js/msdropdown/jquery.dd.min.js' ></script>";
        echo "<link href='/files/dd/css/msdropdown/dd.css' rel='stylesheet' >";
        //echo "<link href='/files/dd/css/msdropdown/skin2.css' rel='stylesheet' >";
        echo "<link href='/files/dd/css/msdropdown/flags.css' rel='stylesheet' >";
         
         
    /* End drop down files */


    /* Load boostraps files */
        
        echo "<script type='application/javascript' src='/files/bootstrap/js/bootstrap.js' ></script>" ; 
        echo "<script type='application/javascript' src='/files/bootstrap/js/bootstrap.min.js' ></script>" ; 
        // else
        //    echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.1/bootstrap.min.js'>";
        echo "<script type='application/javascript' src='/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-carousel.js' ></script>" ; 
        echo "<link href='/files/bootstrap/css/bootstrap.all.css' rel='stylesheet' >" ;
         
         
    /* END loading boostraps files */
    
    /* loading some other files */
        if (!isset($locale))
            $locale = "en_US";
        echo "<script type='application/javascript' src='/files/Gettext.js' ></script>" ; 
          
        echo "<script type='application/javascript' src='/readMongo.php?locale=". $locale."' ></script>" ; 
        echo "<script type='application/javascript' src='/files/js/langSelect.js' ></script>" ; 
        echo "<script type='application/javascript' src='/files/logo.js' ></script>" ; 
        echo "<script type='application/javascript' src='/files/turtle.js' ></script>" ; 
        echo "<script type='application/javascript' src='/files/floodfill.js' ></script>" ; 
        echo "<script type='application/javascript' src='http://www.nihilogic.dk/labs/canvas2image/canvas2image.js'</script>" ; 
        
        echo "<script type='application/javascript' src='/files/interface.js?locale=" .$locale ."' ></script>" ;
        echo "<script type='application/javascript' src='/files/jqconsole.js' ></script>" ; 
        echo "<link rel='stylesheet' href='/files/css/topbar.css' type='text/css' media='all'/>"; 

     /* End loading some other files */ 
?>
