<?php
class includeCssAndJsFiles {
    //Static function to load pages according to page type
    public static function include_all_page_files($pageName) 
    {
        $additional_files = "";
        global $_SESSION , $root_dir , $locale_domain , $site_path; 
        $has_navigator   = false;
        $has_console     = false;
        $has_lessons     = false;
        $has_alerts      = false;
        $has_command_line = false;
        switch ($pageName) {
            case "index":
                $additional_files    = "<link rel='stylesheet' href='".$root_dir."files/css/index.css' type='text/css' media='all'/>";
                
            break;
            case "donate":
                $additional_files    = "<link rel='stylesheet' href='".$root_dir."files/css/donation.css' type='text/css' media='all'/>";
            break;
            case "brainpop":
                $has_navigator       = true;
                $has_console         = true;
                $has_lessons         = true;
                $has_command_line     = true;
               $additional_files = $additional_files . "<link href='".$root_dir."files/bootstrap/css/jquery-ui.css' rel='stylesheet' >" ;
                break;
            case "learn":
                $additional_files = $additional_files . "<script type='application/javascript' src='".$root_dir."files/jqconsole.js' ></script>\n";
                $additional_files = $additional_files . "<script type='application/javascript' src='".$root_dir."files/interface.js?locale=".$locale_domain."'></script>\n";
                $additional_files = $additional_files . "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css'/>\n" ; 
                $additional_files = $additional_files . "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'/>\n" ; 
                $additional_files = $additional_files . "<link rel='stylesheet' href='".$root_dir."files/css/doc.css' type='text/css' media='all'/>\n" ; 
                $additional_files = $additional_files . "<link rel='stylesheet' href='".$root_dir."files/css/interface.css' type='text/css' media='all'/>\n" ;
                $additional_files = $additional_files . "<link href='".$root_dir."files/bootstrap/css/jquery-ui.css' rel='stylesheet' >" ;
                $has_navigator       = true;
                $has_console         = true;
                $has_lessons         = true;
                $has_command_line     = true;
                break;
           case "news":
                $additional_files = $additional_files . "<link rel='stylesheet' href='".$root_dir."files/css/news.css' type='text/css' media='all'/>\n" ;
               break;
           case "registration":
               $additional_files = $additional_files . "<link rel='stylesheet' type='text/css' href='" . $root_dir . "files/css/registration.css' /> ";
               $additional_files = $additional_files . "<link rel='stylesheet' href='".$root_dir."files/css/zocial.css' type='text/css' media='all'/>\n" ;
               $additional_files = $additional_files . "<script type='application/javascript' src='".$root_dir."ajax/libs/jquery/validator/dist/jquery.validate.js'></script>\n";
               break;
           case "doc":
               $additional_files = $additional_files . "<link rel='stylesheet' href='".$root_dir."files/css/doc.css' type='text/css' media='all'/>\n" ;
               $additional_files = $additional_files .  "<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js'></script>"; //Because of the messeging dialog
               break;           
           case "users":
               $additional_files = $additional_files ."<link rel='stylesheet' type='text/css' href='".$root_dir."files/css/users.css'/> "; 
               $additional_files = $additional_files ."<link rel='stylesheet' type='text/css' href='".$root_dir."files/css/badges.css'/> "; 
               $additional_files = $additional_files . "<link href='".$root_dir."files/bootstrap/css/jquery-ui.css' rel='stylesheet' >" ;
               $has_lessons = true; // Because of messeging dialog
               break;
            case "faq":
               $additional_files = $additional_files ."<link rel='stylesheet' type='text/css' href='".$root_dir."files/css/index.css'/> "; 
               $additional_files = $additional_files ."<link rel='stylesheet' type='text/css' href='".$root_dir."files/css/faq.css'/> "; 
               break;
           case "faqadmin":
               $additional_files = $additional_files . "<link rel='stylesheet' type='text/css' href='" . $root_dir . "files/css/registration.css' /> ";
               $additional_files = $additional_files . "<link rel='stylesheet' type='text/css' href='" . $root_dir . "files/css/zocial.css' /> ";
               $additional_files = $additional_files . "<link rel='stylesheet' type='text/css' href='" . $root_dir . "files/css/faq.css' /> ";
               $additional_files = $additional_files . "<script type='application/javascript' src='".$root_dir."ajax/libs/jquery/validator/dist/jquery.validate.js'></script>\n";

               break;
           case "playground":
               $additional_files = $additional_files ."<link rel='stylesheet' type='text/css' href='".$root_dir."files/css/doc.css'/> "; 
               $additional_files = $additional_files ."<link rel='stylesheet' type='text/css' href='".$root_dir."files/css/playground.css'/> "; 
               $additional_files = $additional_files . "<link href='".$root_dir."files/bootstrap/css/jquery-ui.css' rel='stylesheet' >" ;
               $has_console         = true;
               $has_command_line     = true;
               break;
           case "user-program":
               $additional_files = $additional_files . "<script type='application/javascript' src='" . $root_dir . "files/codemirror/lib/codemirror.js' ></script>\n";
               $additional_files = $additional_files . "<script type='application/javascript' src='" . $root_dir . "files/codemirror/addon/runmode/runmode.js' ></script>\n";
               $additional_files = $additional_files . "<script type='application/javascript' src='" . $root_dir . "files/codemirror/addon/edit/closebrackets.js' ></script>\n";
               $additional_files = $additional_files . "<script type='application/javascript' src='" . $root_dir . "files/codemirror/addon/edit/matchbrackets.js' ></script>\n";
               $additional_files = $additional_files . "<script type='application/javascript' src='" . $root_dir . "files/codemirror/addon/display/placeholder.js' ></script>\n";
               $additional_files = $additional_files . "<script type='application/javascript' src='" . $root_dir . "files/codemirror/addon/selection/active-line.js' ></script>\n";
               $additional_files = $additional_files ."<script type='application/javascript' src='" . $root_dir . "files/codemirror/mode/logo/logo.js' ></script>\n";
                $additional_files = $additional_files . "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'/>\n" ; 

               $additional_files = $additional_files . "<link   href='".$root_dir."files/codemirror/mode/logo/logo.css' rel='stylesheet' >";
               
               $additional_files = $additional_files . "<link   href='".$root_dir."files/codemirror/lib/codemirror_turtle.css' rel='stylesheet' >";
               $additional_files = $additional_files . "<script type='application/javascript' src='" . $root_dir . "files/jqconsole.js' ></script>\n";
               $additional_files = $additional_files . "<script type='application/javascript' src='" . $root_dir . "ajax/libs/jquery/editable/jquery.editable.js'></script>";
               $additional_files = $additional_files . "<link   href='".$root_dir."files/codemirror/mode/logo/logo.css' rel='stylesheet'></link>";
               $additional_files = $additional_files . "<script type='application/javascript' src='" . $root_dir . "files/interface_user_program.js?locale=" . $locale_domain."'></script>";
               $has_command_line      = true;
               $has_alerts           = true;
               break;
        }

    includeCssAndJsFiles::includingFiles($additional_files , $has_navigator ,  $has_console ,$has_lessons , $has_alerts , $has_command_line);
    }
    private static function includingFiles($additional_files , $hasNavigator ,  $hasConsole ,$hasLessons , $hasAlerts , $has_command_line)
    {
        global $root_dir,$env , $locale_domain,$site_path;
        /* Load JQuery files */
        if ($env== "local"){ 
            echo "<script type='application/javascript' src='".$root_dir."files/dd/js/jquery/jquery-1.8.2.min.js' ></script>";
        }else{ 
            echo "<script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>";
        }
        if ($hasLessons)
        {
            if ($env == "local")
                echo "<script type='application/javascript' src='".$root_dir."ajax/libs/jqueryui/1.10.0/js/jquery-ui-1.10.0.custom.js' ></script>";
            else
                echo "<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js'></script>";
         }
        if ($hasAlerts)
        {
            echo "<script type='application/javascript' src='".$root_dir."alerts/jquery.alerts.js' ></script>";
            echo "<link   href='".$root_dir."alerts/jquery.alerts.css' rel='stylesheet' >";
        }
        if ($hasNavigator)
        {
            echo "<script type='application/javascript' src='".$root_dir."files/jquery.tmpl.js' ></script>";
        }
        echo "<script type='application/javascript' src='".$root_dir."files/jquery.Storage.js' ></script>";
        
        //echo "<link   href='".$rootDir."ajax/libs/jqueryui/1.10.0//css/ui-lightness/jquery-ui-1.10.0.custom.css' rel='stylesheet' >";
    /* End load Jquery files */
        echo "<script type='application/javascript' src='".$root_dir."loadUsrDataToStorage.php?locale=".$locale_domain."' ></script>\n" ;
    /* Starat DropDown files */
        
        echo "<script type='application/javascript' src='".$root_dir."files/dd/js/msdropdown/jquery.dd.min.js' ></script>";
        
        //One css file that contain the flags and dropdown definitions
        echo "<link href='".$root_dir."files/dd/css/msdropdown/dd-all.css' rel='stylesheet' >";
        //echo "<link href='".$rootDir."files/dd/css/msdropdown/dd.css' rel='stylesheet' >";
        //echo "<link href='".$rootDir."files/dd/css/msdropdown/flags.css' rel='stylesheet' >";
         
         
    /* End drop down files */


    /* Load boostraps files */
        
        //echo "<script type='application/javascript' src='".$rootDir."files/bootstrap/js/bootstrap.js' ></script>" ; 
        echo "<script type='application/javascript' src='".$root_dir."files/bootstrap/js/bootstrap.min.js' ></script>" ; 
        // else
        //    echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.1/bootstrap.min.js'>";
        if ($hasNavigator)
        {    
            echo "<script type='application/javascript' src='".$root_dir."twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-carousel.js' ></script>" ; 
        }
        echo "<link href='".$root_dir."files/bootstrap/css/bootstrap.all.css' rel='stylesheet' >" ;

    
    /* loading some other files */
        if (!isset($locale_domain))
            $locale_domain = "en_US"; 
        echo "<script type='application/javascript' src='".$site_path."files/Gettext.js' ></script>" ; 
        // Loading getText related files according to locale
        $file_path = "locale/" . $locale_domain . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='$site_path/locale/" . $locale_domain . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            try{
                echo $po_file;
            }catch(Exception $e)
            {
               $po_file =  "<link   rel='gettext' type='application/x-po' href='$site_pate_with_www/locale/" . $locale_domain . "/LC_MESSAGES/messages.po'" . " />"; 
               echo $po_file;
            }
        
        //End Loading translation file   
        $is_user_login =   isset($_SESSION['username']);
        if ($is_user_login) {
             echo "<script type='application/javascript' src='".$root_dir."clearStorageData.php' ></script>\n" ;   
        } 
        if ($hasLessons)
        {
            echo "<script type='application/javascript' src='".$root_dir."readMongo.php?locale=".$locale_domain."' ></script>\n" ;  
        }
        echo "<script type='application/javascript' src='".$root_dir."files/js/langSelect.js' ></script>\n" ; 
        echo "<script type='application/javascript' src='".$root_dir."files/logo.js' ></script>\n" ; 
        echo "<script type='application/javascript' src='".$root_dir."files/turtle.js' ></script>\n" ; 
        if ($has_command_line)
        {
            echo "<script type='application/javascript' src='".$root_dir."files/floodfill.js' ></script>\n" ; 
        }
        
        
        echo "<link rel='stylesheet' href='".$root_dir."files/css/topbar.css' type='text/css' media='all'/>"; 
        echo "<link rel='stylesheet' href='".$root_dir."files/css/footer.css' type='text/css' media='all'/>";
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
    echo $additional_files;
    }   
}
?>