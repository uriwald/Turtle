<?php
class includeCssAndJsFiles {
    //Static function to load pages according to page type
    public static function includePageFiles($pageName) 
    {
        $additionalFiles = "";
        global $_SESSION , $rootDir , $localeDomain , $sitePath; 
        $hasNavigator   = false;
        $hasConsole     = false;
        $hasLessons     = false;
        $hasAlerts      = false;
        $hasCommandLine = false;
        switch ($pageName) {
            case "index":
                $additionalFiles    = "<link rel='stylesheet' href='".$rootDir."files/css/index.css' type='text/css' media='all'/>";
                
            break;
            case "donate":
                $additionalFiles    = "<link rel='stylesheet' href='".$rootDir."files/css/donation.css' type='text/css' media='all'/>";
            break;
            case "brainpop":
                $hasNavigator       = true;
                $hasConsole         = true;
                $hasLessons         = true;
                $hasCommandLine     = true;
               $additionalFiles = $additionalFiles . "<link href='".$rootDir."files/bootstrap/css/jquery-ui.css' rel='stylesheet' >" ;
                break;
            case "learn":
                $additionalFiles = $additionalFiles . "<script type='application/javascript' src='".$rootDir."files/jqconsole.js' ></script>\n";
                $additionalFiles = $additionalFiles . "<script type='application/javascript' src='".$rootDir."files/interface.js?locale=".$localeDomain."'></script>\n";
                $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css'/>\n" ; 
                $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'/>\n" ; 
                $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='".$rootDir."files/css/doc.css' type='text/css' media='all'/>\n" ; 
                $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='".$rootDir."files/css/interface.css' type='text/css' media='all'/>\n" ;
                $additionalFiles = $additionalFiles . "<link href='".$rootDir."files/bootstrap/css/jquery-ui.css' rel='stylesheet' >" ;
                $hasNavigator       = true;
                $hasConsole         = true;
                $hasLessons         = true;
                $hasCommandLine     = true;
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
               $additionalFiles = $additionalFiles .  "<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js'></script>"; //Because of the messeging dialog
               break;           
           case "users":
               $additionalFiles = $additionalFiles ."<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/users.css'/> "; 
               $additionalFiles = $additionalFiles ."<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/badges.css'/> "; 
               $additionalFiles = $additionalFiles . "<link href='".$rootDir."files/bootstrap/css/jquery-ui.css' rel='stylesheet' >" ;
               $hasLessons = true; // Because of messeging dialog
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
           case "playground":
               $additionalFiles = $additionalFiles ."<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/doc.css'/> "; 
               $additionalFiles = $additionalFiles ."<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/playground.css'/> "; 
               $additionalFiles = $additionalFiles . "<link href='".$rootDir."files/bootstrap/css/jquery-ui.css' rel='stylesheet' >" ;
               $hasConsole         = true;
               $hasCommandLine     = true;
               break;
           case "user-program":
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='" . $rootDir . "files/codemirror/lib/codemirror.js' ></script>\n";
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='" . $rootDir . "files/codemirror/addon/runmode/runmode.js' ></script>\n";
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='" . $rootDir . "files/codemirror/addon/edit/closebrackets.js' ></script>\n";
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='" . $rootDir . "files/codemirror/addon/edit/matchbrackets.js' ></script>\n";
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='" . $rootDir . "files/codemirror/addon/display/placeholder.js' ></script>\n";
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='" . $rootDir . "files/codemirror/addon/selection/active-line.js' ></script>\n";
               $additionalFiles = $additionalFiles ."<script type='application/javascript' src='" . $rootDir . "files/codemirror/mode/logo/logo.js' ></script>\n";
                $additionalFiles = $additionalFiles . "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'/>\n" ; 

               $additionalFiles = $additionalFiles . "<link   href='".$rootDir."files/codemirror/mode/logo/logo.css' rel='stylesheet' >";
               
               $additionalFiles = $additionalFiles . "<link   href='".$rootDir."files/codemirror/lib/codemirror_turtle.css' rel='stylesheet' >";
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='" . $rootDir . "files/jqconsole.js' ></script>\n";
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='" . $rootDir . "ajax/libs/jquery/editable/jquery.editable.js'></script>";
               $additionalFiles = $additionalFiles . "<link   href='".$rootDir."files/codemirror/mode/logo/logo.css' rel='stylesheet'></link>";
               $additionalFiles = $additionalFiles . "<script type='application/javascript' src='" . $rootDir . "files/interface_user_program.js?locale=" . $localeDomain."'></script>";
               $hasCommandLine      = true;
               $hasAlerts           = true;
               break;
        }

    includeCssAndJsFiles::includingFiles($additionalFiles , $hasNavigator ,  $hasConsole ,$hasLessons , $hasAlerts , $hasCommandLine);
    }
    private static function includingFiles($additionalFiles , $hasNavigator ,  $hasConsole ,$hasLessons , $hasAlerts , $hasCommandLine)
    {
        global $rootDir,$env , $localeDomain,$sitePath;
        /* Load JQuery files */
        if ($env== "local"){ 
            echo "<script type='application/javascript' src='".$rootDir."files/dd/js/jquery/jquery-1.8.2.min.js' ></script>";
        }else{ 
            echo "<script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>";
        }
        if ($hasLessons)
        {
            if ($env == "local")
                echo "<script type='application/javascript' src='".$rootDir."ajax/libs/jqueryui/1.10.0/js/jquery-ui-1.10.0.custom.js' ></script>";
            else
                echo "<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js'></script>";
         }
        if ($hasAlerts)
        {
            echo "<script type='application/javascript' src='".$rootDir."alerts/jquery.alerts.js' ></script>";
            echo "<link   href='".$rootDir."alerts/jquery.alerts.css' rel='stylesheet' >";
        }
        if ($hasNavigator)
        {
            echo "<script type='application/javascript' src='".$rootDir."files/jquery.tmpl.js' ></script>";
        }
        echo "<script type='application/javascript' src='".$rootDir."files/jquery.Storage.js' ></script>";
        
        //echo "<link   href='".$rootDir."ajax/libs/jqueryui/1.10.0//css/ui-lightness/jquery-ui-1.10.0.custom.css' rel='stylesheet' >";
    /* End load Jquery files */
        echo "<script type='application/javascript' src='".$rootDir."loadUsrDataToStorage.php?locale=".$localeDomain."' ></script>\n" ;
    /* Starat DropDown files */
        
        echo "<script type='application/javascript' src='".$rootDir."files/dd/js/msdropdown/jquery.dd.min.js' ></script>";
        
        //One css file that contain the flags and dropdown definitions
        echo "<link href='".$rootDir."files/dd/css/msdropdown/dd-all.css' rel='stylesheet' >";
        //echo "<link href='".$rootDir."files/dd/css/msdropdown/dd.css' rel='stylesheet' >";
        //echo "<link href='".$rootDir."files/dd/css/msdropdown/flags.css' rel='stylesheet' >";
         
         
    /* End drop down files */


    /* Load boostraps files */
        
        //echo "<script type='application/javascript' src='".$rootDir."files/bootstrap/js/bootstrap.js' ></script>" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/bootstrap/js/bootstrap.min.js' ></script>" ; 
        // else
        //    echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.1/bootstrap.min.js'>";
        if ($hasNavigator)
        {    
            echo "<script type='application/javascript' src='".$rootDir."twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-carousel.js' ></script>" ; 
        }
        echo "<link href='".$rootDir."files/bootstrap/css/bootstrap.all.css' rel='stylesheet' >" ;

    
    /* loading some other files */
        if (!isset($localeDomain))
            $localeDomain = "en_US"; 
        echo "<script type='application/javascript' src='".$sitePath."files/Gettext.js' ></script>" ; 
        // Loading getText related files according to locale
        $file_path = "locale/" . $localeDomain . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='$sitePath/locale/" . $localeDomain . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
        
        //End Loading translation file   
        $isUserLoggedIn =   isset($_SESSION['username']);
        if ($isUserLoggedIn) {
             echo "<script type='application/javascript' src='".$rootDir."clearStorageData.php' ></script>\n" ;   
        } 
        if ($hasLessons)
        {
            echo "<script type='application/javascript' src='".$rootDir."readMongo.php?locale=".$localeDomain."' ></script>\n" ;  
        }
        echo "<script type='application/javascript' src='".$rootDir."files/js/langSelect.js' ></script>\n" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/logo.js' ></script>\n" ; 
        echo "<script type='application/javascript' src='".$rootDir."files/turtle.js' ></script>\n" ; 
        if ($hasCommandLine)
        {
            echo "<script type='application/javascript' src='".$rootDir."files/floodfill.js' ></script>\n" ; 
        }
        
        
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