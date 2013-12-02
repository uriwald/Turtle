<?php
class includeCssAndJsFiles {
    //Static function to load pages according to page type
    public static function includePageFiles($pageName) 
    {
        $additionalFiles = "";
        global $_SESSION , $rootDir , $localeDomain;
        switch ($pageName) {
            case "index":
                $additionalFiles = "<link rel='stylesheet' href='".$rootDir."files/css/index.css' type='text/css' media='all'/>";
            break;
        
            case "learn":
                $additionalFiles = $additionalFiles . "<script type='application/javascript' src='".$rootDir."files/jqconsole.js' ></script>\n";
                $additionalFiles = $additionalFiles . "<script type='application/javascript' src='".$rootDir."files/interface.js?locale=".$localeDomain."'></script>\n";
                $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css'/>\n" ; 
                $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'/>\n" ; 
                $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='".$rootDir."files/css/doc.css' type='text/css' media='all'/>\n" ; 
                $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='".$rootDir."files/css/interface.css' type='text/css' media='all'/>\n" ;
                break;
           case "news":
                $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='".$rootDir."files/css/news.css' type='text/css' media='all'/>\n" ;
               break;
           case "registration":
               $additionalFiles = $additionalFiles . "<link rel='stylesheet' type='text/css' href='" . $rootDir . "files/css/registration.css' /> ";
               $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='".$rootDir."files/css/zocial.css' type='text/css' media='all'/>\n" ;
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='".$rootDir."ajax/libs/jquery/validator/dist/jquery.validate.js'></script>\n";
               break;
           case "doc":
               $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='".$rootDir."files/css/doc.css' type='text/css' media='all'/>\n" ;
               break;           
           case "users":
               $additionalFiles = $additionalFiles ."<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/users.css'/> "; 
               $additionalFiles = $additionalFiles ."<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/badges.css'/> "; 
               break;
            case "faq":
               $additionalFiles = $additionalFiles ."<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/index.css'/> "; 
               $additionalFiles = $additionalFiles ."<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/faq.css'/> "; 
               break;
           case "faqadmin":
               $additionalFiles = $additionalFiles . "<link rel='stylesheet' type='text/css' href='" . $rootDir . "files/css/registration.css' /> ";
               $additionalFiles = $additionalFiles . "<link rel='stylesheet' type='text/css' href='" . $rootDir . "files/css/zocial.css' /> ";
               $additionalFiles = $additionalFiles . "<link rel='stylesheet' type='text/css' href='" . $rootDir . "files/css/faq.css' /> ";
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='".$rootDir."ajax/libs/jquery/validator/dist/jquery.validate.js'></script>\n";

               break;
           case "create-program":
               
               break;
        }

    includeCssAndJsFiles::includingFiles($additionalFiles);
    }
    private static function includingFiles($additionalFiles)
    {
        global $rootDir,$env , $localeDomain;
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

    
    /* loading some other files */
        if (!isset($localeDomain))
            $localeDomain = "en_US";
        echo "<script type='application/javascript' src='".$rootDir."files/Gettext.js' ></script>" ; 
        // Loading getText related files according to locale
        $file_path = "locale/" . $localeDomain . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='" . $rootDir . "locale/" . $localeDomain . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
        
        //End Loading translation file   
        $isUserLoggedIn =   isset($_SESSION['username']);
        if ($isUserLoggedIn) {
             echo "<script type='application/javascript' src='".$rootDir."clearStorageData.php' ></script>\n" ;   
        } 
        echo "<script type='application/javascript' src='".$rootDir."readMongo.php?locale=".$localeDomain."' ></script>\n" ;  
        echo "<script type='application/javascript' src='".$rootDir."files/js/langSelect.js' ></script>\n" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/logo.js' ></script>\n" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/turtle.js' ></script>\n" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/floodfill.js' ></script>\n" ; 
        
        
        echo "<link rel='stylesheet' href='".$rootDir."files/css/topbar.css' type='text/css' media='all'/>"; 
        echo "<link rel='stylesheet' href='".$rootDir."files/css/footer.css' type='text/css' media='all'/>"; 
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
    <?php
    echo $additionalFiles;
    }
    
}


?>