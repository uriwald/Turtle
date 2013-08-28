<?php
    if(session_id() == '') 
        session_start();
    require_once("environment.php");
    require_once("localization.php");
    $locale = "he_IL";
            
    $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
    $po_file =  "<link   rel='gettext' type='application/x-po' href='"."locale/".$locale."/LC_MESSAGES/messages.po'"." />";       
    if ( file_exists($file_path))
    {
        /*
        ?>
        <link   rel='gettext' type='application/x-po' href='locale/he_IL/LC_MESSAGES/messages.po' />
        </head>
        <?php
         */
    }
    $localeEnv = "he_IL.utf8";
    putenv("LC_ALL=$localeEnv");
    setlocale(LC_ALL, $localeEnv);
    //setlocale(LC_ALL, "sp_SP.utf8");
    bindtextdomain("messages", "./locale");
    textdomain("messages");
    bind_textdomain_codeset("messages", 'UTF-8');
    echo _("TurtleAcademy");
       
?>
