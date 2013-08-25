<?php

/* Including all .js and .css files for each webpage */
//require_once("./environment.php");

    /* Load JQuery files */
        if ($env== "local"){ 
            echo "<script type='application/javascript' src='".$rootDir."files/dd/js/jquery/jquery-1.8.2.min.js' ></script>";
        }else{ 
            echo "<script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>";
        }
        if ($env == "local")
            echo "<script type='application/javascript' src='".$rootDir."ajax/libs/jqueryui/1.10.0/js/jquery-ui-1.10.0.custom.js' ></script>";
        else
            echo "<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js'></script>";
        echo "<script type='application/javascript' src='".$rootDir."alerts/jquery.alerts.js' ></script>";
        echo "<script type='application/javascript' src='".$rootDir."files/jquery.tmpl.js' ></script>";
        echo "<script type='application/javascript' src='".$rootDir."files/jquery.Storage.js' ></script>";
        echo "<link   href='".$rootDir."alerts/jquery.alerts.css' rel='stylesheet' >";
        echo "<link   href='".$rootDir."ajax/libs/jqueryui/1.10.0//css/ui-lightness/jquery-ui-1.10.0.custom.css' rel='stylesheet' >";
    /* End load Jquery files */
    
    /* Starat DropDown files */
        
        echo "<script type='application/javascript' src='".$rootDir."files/dd/js/msdropdown/jquery.dd.min.js' ></script>";
        echo "<link href='".$rootDir."files/dd/css/msdropdown/dd.css' rel='stylesheet' >";
        //echo "<link href='/files/dd/css/msdropdown/skin2.css' rel='stylesheet' >";
        echo "<link href='".$rootDir."files/dd/css/msdropdown/flags.css' rel='stylesheet' >";
         
         
    /* End drop down files */


    /* Load boostraps files */
        
        echo "<script type='application/javascript' src='".$rootDir."files/bootstrap/js/bootstrap.js' ></script>" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/bootstrap/js/bootstrap.min.js' ></script>" ; 
        // else
        //    echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.1/bootstrap.min.js'>";
        echo "<script type='application/javascript' src='".$rootDir."twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-carousel.js' ></script>" ; 
        echo "<link href='".$rootDir."files/bootstrap/css/bootstrap.all.css' rel='stylesheet' >" ;
         
         
    /* END loading boostraps files */
    
    /* loading some other files */
        if (!isset($locale))
            $locale = "en_US";
        echo "<script type='application/javascript' src='".$rootDir."files/Gettext.js' ></script>" ; 
        // Loading getText related files according to locale
        $file_path = "locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='" . $rootDir . "locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
        
        //End Loading translation file   
        echo "<script type='application/javascript' src='".$rootDir."readMongo.php?locale=".$locale."' ></script>" ;  
        echo "<script type='application/javascript' src='".$rootDir."files/js/langSelect.js' ></script>" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/logo.js' ></script>" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/turtle.js' ></script>" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/floodfill.js' ></script>" ; 
        echo "<script type='application/javascript' src='http://www.nihilogic.dk/labs/canvas2image/canvas2image.js'</script>" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/interface.js?locale=".$locale."'></script>" ;
        echo "<script type='application/javascript' src='".$rootDir."files/jqconsole.js' ></script>" ; 
        echo "<link rel='stylesheet' href='".$rootDir."files/css/topbar.css' type='text/css' media='all'/>"; 

     /* End loading some other files */ 
        

  ?> 
    <!-- Google Analytics Tracking --> 
    <script type="application/javascript"> 
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-26588530-1']);
        _gaq.push(['_trackPageview']);

        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <!-- End of Google Analytics Tracking --> 

