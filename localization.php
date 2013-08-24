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
        {
            $localeEnv = $_GET["ltranslate"].".utf8";
        }
        else
        {
            $localeEnv  = "en_US.utf8";
            $locale     = "en_US";
        }
    }
     else {
       $localeEnv = $locale.".utf8" ; 
    } 
    $_SESSION['locale'] = $locale;
    $lang               =  substr($locale, 0, 2);
    $dir = ($locale == 'he_IL') ? 'rtl' : 'ltr';
    $cssright = ($dir == 'ltr') ? 'right' : 'left';
    $cssleft = ($dir == 'ltr') ? 'left' : 'right';
    //echo " locale env is " . $localeEnv ;
    putenv("LC_ALL=$localeEnv");
    setlocale(LC_ALL, $localeEnv);
    //setlocale(LC_ALL, "sp_SP.utf8");
    bindtextdomain("messages", "./locale");
    textdomain("messages");
    
?>
    <!-- In order to infrom js files on which locale are we right now -->
    <script type="text/javascript">
            var locale = "<?php echo $locale; ?>";
    </script>
