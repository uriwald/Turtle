<?php
if (session_id() == '')
    session_start();

//Setting the locale
if (!isset($locale)) {
    if (isset($_SESSION['locale']))
        $locale = $_SESSION['locale'];
    else {
        $locale = "en_US";
        $_SESSION['locale'] = "en_US";
    }
} else {
    $_SESSION['locale'] = $locale;
}
  $localePage =   substr($locale, 0, -3); 
require_once("environment.php");
require_once("localization.php");
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
             include_once("files/inc/dropdowndef.php");
             include_once("files/inc/jquerydef.php");
             include_once("files/inc/boostrapdef.php");
        ?>
        <meta name="description" content="Twitter Bootstrap ScrollSpy example. You may also learn usage of navbar and dropdown.">
        <link href="files/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/css/bootstrap.css" rel="stylesheet"> 
        <style type="text/css">
            .scrollspy-example {
                height: 200px;
                overflow: auto;
                position: relative;
            }
        </style>

        <script type="application/javascript" src="<?php echo $rootDir; ?>files/js/langSelect.js"></script> <!-- Language select --> 
        
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/turtle.js"></script> <!-- Canvas turtle -->
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
        <script type="application/javascript" src="<?php echo $rootDir; ?>readMongo.php?locale=<?php echo $locale ?>"></script> <!-- Lessons scripts -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/Gettext.js"></script> <!-- Using JS GetText -->

        <script type="application/javascript" src="<?php echo $rootDir; ?>files/jqconsole.js"></script> <!-- Console -->

        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/interface.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/topbar.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/footer.css' type='text/css' media='all'/> 
        <?php
        cssUtils::loadcss($locale, $rootDir . "files/css/interface");
        cssUtils::loadcss($locale, $rootDir . "files/css/doc");
        cssUtils::loadcss($locale, $rootDir . "files/css/topbar");
        cssUtils::loadcss($locale, $rootDir . "files/css/news");
        ?>     
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
        $topbarDisplay['helpus']        = false ;
        $topbarDisplay['playground']    = false ;
        $topbarDisplay['forum']         = false ;
        $topbarDisplay['news']          = false ;
        $topbarDisplay['about']         = false ; 
        $topbarDisplay['sample']        = false ;
        $signUpDisplay                  = true ;
        $languagesDisplay               = true ;
        $language['en'] = "en_US";$language['ru'] = "ru_RU";
        $language['es'] = "es_AR";$language['zh'] = "zh_CN";$language['he'] = "he_IL";
        $topbar->printTopBar($rootDir , $class , $login , $topbarDisplay , $languagesDisplay , $signUpDisplay ,
               $language ,  $_SESSION);
        ?>
       
        <div id="turtleNewsBody" class="span16 columns" style="margin:0 auto;float:none;"> 
            <h2><?php echo _("The Turtle news"); ?></h2>
            <p><?php echo _("Here you will find updates about the turtle development"); ?></p>

                <div id="navbarExample" class="navbar navbar-static">
                    <div class="navbar-inner" id="navbar-inner-id">
                        <div class="container" style="width: auto;">
                            <a id="newsBarBrand" class="brand" href="#"><?php echo _('TurtleAcademy'); echo " "; echo _("news"); ?></a>
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
                <div data-spy="scroll" id="divScroll" data-target="#navbarExample" data-offset="50" class="scrollspy-example">
                    <h3 id="<?php echo $itemid ?>"> <span><?php echo $headline ?> </span> <span id="newsDate"><?php echo $date; ?> </span></h3>
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
           selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $rootDir; ?>turtlenews.php?locale=" , "turtlenews.php" ,"en_US" );
           })
          /*
                    $('.dropdown-toggle').dropdown();
                    $.Storage.set("locale","<?php echo $_SESSION['locale']; ?>");
                    //Show selected lanugage from dropdown                   
                    try { 
                            var pages = $("#selectedLanguage").msDropdown({on:{change:function(data, ui) {
                                    var val = data.value;
                                    if(val!="")
                                           window.location = "<?php echo $rootDir; ?>turtlenews.php?locale=" + val; 
                            }}}).data("dd");
                    var pagename    = document.location.pathname.toString();
                            pagename        = pagename.split("/");
                            var pageIndex   = pagename[pagename.length-1];
                            if (pageIndex == "" || pageIndex == "turtlenews.php" )
                                 pageIndex   = "en_US";
                            pages.setIndexByValue(pageIndex);
                            //$("#ver").html(msBeautify.version.msDropdown);
                    } catch(e) {
                            //console.log(e);	
                    }
                   

                    //convert
                    $("select").msDropdown();
                    //createByJson();
                    $("#tech").data("dd");             
                    });
                        function showValue(h) {
                                    console.log(h.name, h.value);
                            }
                            $("#tech").change(function() {
                                    console.log("by jquery: ", this.value);
                            })
                            */
        </script>
</html>