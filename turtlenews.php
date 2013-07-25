<?php
if (session_id() == '')
    session_start();
require_once("environment.php");
require_once("localization.php");
//Setting the locale
if (!isset($locale)) {
    if (isset($_SESSION['locale']))
    {
        $locale = $_SESSION['locale'];
    }
    else {
        $locale = "en_US";
        $_SESSION['locale'] = "en_US";
    }
} else {
    $_SESSION['locale'] = $locale;
}
  $lang       =  substr($locale, 0, 2);


require_once("files/footer.php");
require_once("files/cssUtils.php");
require_once ('files/utils/topbarUtil.php');
  
$m = new Mongo();
$db = $m->turtleTestDb;
$newscol = $db->news;

$newsQuery = array('approve' => true);
$newsItems = $newscol->find($newsQuery);
?>
<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8"> 
        <title>TurtleAcademy news</title> 
        <?php
            require_once("files/utils/loadDd.php");
            require_once("files/utils/loadJq.php");
            require_once("files/utils/loadBs.php");
            require_once("files/utils/loadTurtle.php");
            $dd = new loadDd($rootDir , $env , "files/test/dd/"); 
            $jq = new loadJq($rootDir , $env );
            $bs = new loadBs($rootDir , $env , "files/bootstrap/");
            $lt = new loadTurtle($locale , $rootDir , $env  );
            $dd->loadFiles(true, true, true, false, true); /* 182 min.js , dd.js , dd.css , skin2.css , flags.css*/
            $jq->loadFiles(true, false, true, true, true, false , true); /* jquery-ui.min , alerts.js , tmpl.js , storage.js , custom.css */
            $bs->loadFiles(false , true ,true , true); /*bs.js , bs_min.js ,bootstrap-carousel.js , bs_all.css */
            $lt->loadFiles(true,false,false,false,false,false,true,false,false); /*langSelect.js , logo.js , turtle.js , floodfill.js , canvas2image.js , readMongo , Gettext.js , interface.js , jqconsole.js */
            
        ?>
        <meta name="description" content="Twitter Bootstrap ScrollSpy example. You may also learn usage of navbar and dropdown.">  

        
        <?php
        $file_path = "../locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='../locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path)) 
            echo $po_file;
        ?>        
        <script type="text/javascript">
            var locale = "<?php echo $locale; ?>";
        </script>
        <!--<link   rel="gettext" type="application/x-po" href="locale/he_IL/LC_MESSAGES/messages.po" /> <!-- Static Loading hebrew definition -->

        <?php
        cssUtils::loadcss($locale, $rootDir . "files/css/interface");
        ?>    
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/topbar.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/doc.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/news.css' type='text/css' media='all'/>
        <!-- Disable script when working without internet -->
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
    </head>
    <body align="center"> 
        <?php
        $class = ($locale == "he_IL" ? "pull-right" : "pull-left");
        $login = ($locale != "he_IL" ? "pull-right" : "pull-left");
        
        $topbar = new topbarUtil();
        $topbarDisplay['turtleacademy'] = true ;
        $topbarDisplay['exercise']      = true ;  
        $topbarDisplay['helpus']        = false ;
        $topbarDisplay['playground']    = false ;
        $topbarDisplay['forum']         = false ;
        $topbarDisplay['news']          = false ;
        $topbarDisplay['about']         = false ; 
        $topbarDisplay['sample']        = false ;
        $signUpDisplay                  = true ;
        $languagesDisplay               = true ;
        $language['en'] = "en";$language['ru'] = "ru";
        $language['es'] = "es";$language['zh'] = "zh";$language['he'] = "he";
        $topbar->printTopBar($rootDir , $class , $login , $topbarDisplay , $languagesDisplay , $signUpDisplay ,
               $language ,  $_SESSION);
        ?>
       
        <div id="turtleNewsBody" class="span16 columns" lang="<?php echo $lang?>"> 
            <h2><?php echo _("The Turtle news"); ?></h2>
            <p><?php echo _("Here you will find updates about the turtle development"); ?></p>

                <div id="navbarExample" class="navbar navbar-static" lang="<?php echo $lang?>">
                    <div class="navbar-inner" id="navbar-inner-id">
                        <div class="container" style="width: auto;">
                            <a id="newsBarBrand" class="brand" lang="<?php echo $lang?>" href="#"><?php echo _('TurtleAcademy'); echo " "; echo _("news"); ?></a>
                            <ul class="nav newsmenu">
                                <?php
                                    $i = 1 ;
                                    foreach ($newsItems as $newsItem) {
                                        //echo $i;
                                        $i++;
                                        $headline = $newsItem['headline'];
                                        $context  = $newsItem['context'];
                                        $itemid   = $newsItem['itemid'];
                                        $date     = $newsItem['date'];
                                        if ($locale != "en_US") {
                                            $localestr = "locale_" . $locale;
                                            if (isset($newsItem['headline_translate'][$localestr]))
                                                $headline = $newsItem['headline_translate'][$localestr];
                                            if (isset($newsItem['context_translate'][$localestr]))
                                                $context = $newsItem['context_translate'][$localestr]; 
                                            //echo $headline . $context;
                                        }
                                ?>
                                    <!-- <li class="active newsmenu"><a href="#<?php echo $itemid ?>"> <?php echo $headline ?></a></li> -->
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php
$i = 1 ;
foreach ($newsItems as $newsItem) {
    //echo $i;
    $i++;
    $headline = $newsItem['headline'];
    $context  = $newsItem['context'];
    $itemid   = $newsItem['itemid'];
    $date     = $newsItem['date'];
    if ($locale != "en_US") {
        $localestr = "locale_" . $locale;
        if (isset($newsItem['headline_translate'][$localestr]))
            $headline = $newsItem['headline_translate'][$localestr];
        if (isset($newsItem['context_translate'][$localestr]))
            $context = $newsItem['context_translate'][$localestr]; 
        //echo $headline . $context;
    }
    if (strlen($headline) > 3) //Check if the header is valid for this language
    {
    ?> 
                <div data-spy="scroll" id="divScroll" data-target="#navbarExample" data-offset="50" class="scrollspy-example" lang="<?php echo $lang?>">
                    <h3 id="<?php echo $itemid ?>"> <span><?php echo $headline ?> </span> <span id="newsDate" lang="<?php echo $lang?>"><?php echo $date; ?> </span></h3>
                    <p><?php echo $context; ?></p>
                </div>
    <?php
    } //End of checking if headline is really exist
}
?>
            <hr>
        </div>
        <!--
        <script src="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>
        <script src="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-dropdown.js"></script>
        <script src="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-scrollspy.js"></script>
        -->
    </body>
    <script>
        // Select language in main page
       
      $(document).ready(function() {
           selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $rootDir; ?>news/" , "turtlenews.php" ,"en_US" );
      })
        
        </script>
</html>