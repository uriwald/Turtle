<?php

    require_once("environment.php");
    
    $locale = "he_IL";
    $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
    $po_file =  "<link   rel='gettext' type='application/x-po' href='".$root_dir."locale/".$locale."/LC_MESSAGES/messages.po'"." />";       
     if ( file_exists($file_path))
        echo $po_file; 
     //require_once("localization.php");
     $localeEnv = $locale . "utf8";
        putenv("LANG=he_IL");
        setlocale(LC_ALL, "he_IL");
        bindtextdomain("messages", "./locale");
        textdomain("messages");
     echo _("Sample");
     
     /*
     putenv("LANG=$language"); 
setlocale(LC_ALL, $language);

// Set the text domain as 'messages'
$domain = 'messages';
bindtextdomain($domain, "/www/htdocs/site.com/locale"); 
textdomain($domain);
         */
?>
