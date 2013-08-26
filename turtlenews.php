<?php
if (session_id() == '')
    session_start();
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
require_once("files/utils/includeCssAndJsFiles.php");
?>
        <meta name="description" content="Twitter Bootstrap ScrollSpy example. You may also learn usage of navbar and dropdown.">  


<?php
//Language translation file
$file_path = "../locale/" . $locale . "/LC_MESSAGES/messages.po";
$po_file = "<link   rel='gettext' type='application/x-po' href='../locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
if (file_exists($file_path))
    echo $po_file;
?>        
        <?php
        cssUtils::loadcss($locale, $rootDir . "files/css/interface");
        ?>    
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/topbar.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/news.css' type='text/css' media='all'/>
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
    </head>
    <body align="center"> 
    <?php
    //Printing the topbar menu
            $topbar = new topbarUtil();
            $topbar->printTopBar("news"); 
    ?>

        <div id="turtleNewsBody" class="span16 columns" lang="<?php echo $lang ?>"> 
            <h2><?php echo _("The Turtle news"); ?></h2>
            <p><?php echo _("Here you will find updates about the turtle development"); ?></p>          
            <!-- News Items topbar menu nav -->
            <div id="navbarExample" class="navbar navbar-static" lang="<?php echo $lang ?>">
                <div class="navbar-inner" id="navbar-inner-id">
                    <div class="container" style="width: auto;">
                        <a id="newsBarBrand" class="brand" lang="<?php echo $lang ?>" href="#">
                        <?php 
                            echo _('TurtleAcademy');
                            echo " ";
                            echo _("news"); 
                        ?>
                        </a>
                        <ul class="nav newsmenu">
                            <?php
                            foreach ($newsItems as $newsItem) {
                                $headline = $newsItem['headline'];
                                $context = $newsItem['context'];
                                $itemid = $newsItem['itemid'];
                                $date = $newsItem['date'];
                                if ($locale != "en_US") {
                                    $localestr = "locale_" . $locale;
                                    if (isset($newsItem['headline_translate'][$localestr]))
                                        $headline = $newsItem['headline_translate'][$localestr];
                                    if (isset($newsItem['context_translate'][$localestr]))
                                        $context = $newsItem['context_translate'][$localestr];
                                }
                                ?>
                                    <!-- <li class="active newsmenu"><a href="#<?php echo $itemid ?>"> <?php echo $headline ?></a></li> -->
                            <?php 
                            } 
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End of News Items topbar menu nav -->
            <?php
                $i = 1;
                foreach ($newsItems as $newsItem) {
                    $i++;
                    $headline = $newsItem['headline'];
                    $context = $newsItem['context'];
                    $itemid = $newsItem['itemid'];
                    $date = $newsItem['date'];
                    if ($locale != "en_US") {
                        $localestr = "locale_" . $locale;
                        if (isset($newsItem['headline_translate'][$localestr]))
                            $headline = $newsItem['headline_translate'][$localestr];
                        if (isset($newsItem['context_translate'][$localestr]))
                            $context = $newsItem['context_translate'][$localestr];
                        //echo $headline . $context;
                    }
                    if (strlen($headline) > 3) { //Check if the header is valid for this language
                        ?> 
                        <div data-spy="scroll" id="divScroll" data-target="#navbarExample" data-offset="50" class="scrollspy-example" lang="<?php echo $lang ?>">
                            <h3 id="<?php echo $itemid ?>"> <span><?php echo $headline ?> </span> <span id="newsDate" lang="<?php echo $lang ?>"><?php echo $date; ?> </span></h3>
                            <p><?php echo $context; ?></p>
                        </div>
                        <?php
                    } //End of checking if headline is really exist
                }
            ?>
        </div>
    </body>
    <script>
        // Select language in main page
        $(document).ready(function() {
            selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $rootDir; ?>news/" , "turtlenews.php" ,"en_US" );
        })
        
    </script>
</html>