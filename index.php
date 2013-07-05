
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
    <?php
    if (session_id() == '')
        session_start();
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
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    require_once("files/utils/languageUtil.php");
    require_once ('files/openid.php');
    require_once ('files/utils/topbarUtil.php');
    ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
<?php
echo _("Turtle Academy - learn logo programming in your browser");
echo _(" free programming materials for kids");
//        אקדמיית הצב - למד תכנות לוגו היישר מתוך הדפדפן                
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$currentPage = $parts[count($parts) - 1];
?>  

        </title>      
            <?php
            include_once("files/inc/dropdowndef.php");
            include_once("files/inc/jquerydef.php");
            include_once("files/inc/boostrapdef.php");
            if (isset($_SESSION['username'])) {
                ?>   
            <script type="application/javascript" src="<?php echo $rootDir; ?>clearStorageData.php"></script>
            <?php
        }
        ?>
        <script src="<?php echo $rootDir; ?>twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-carousel.js"></script>
        <link href="<?php echo $rootDir; ?>twitter-bootstrap/twitter-bootstrap-v2/docs/assets/css/bootstrap.css" rel="stylesheet">
        
        
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/js/langSelect.js"></script> <!-- Language select -->                         
        <?php
        $file_path = "locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='" . $rootDir . "locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
        ?>       
        <script type="text/javascript">
            var locale = "<?php echo $locale; ?>";
        </script>
        <!--<link   rel="gettext" type="application/x-po" href="locale/he_IL/LC_MESSAGES/messages.po" /> <!-- Static Loading hebrew definition -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/Gettext.js"></script> <!-- Using JS GetText -->

        <!-- Adding new boostrap for crusel --> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/interface.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/topbar.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/footer.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/zocial.css' type='text/css' media='all'/>
        <?php
            cssUtils::loadcss($locale, $rootDir . "files/css/interface");
            cssUtils::loadcss($locale, $rootDir . "files/css/doc");
            cssUtils::loadcss($locale, $rootDir . "files/css/topbar");
            cssUtils::loadcss($locale, $rootDir . "files/css/index");
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
    </head>
    <div id="index-main">
        <!-- Should be different for log in user and for a guest -->
        <?php
        $class = ($locale == "he_IL" ? "pull-right" : "pull-left");
        $login = ($locale != "he_IL" ? "pull-right" : "pull-left");

        $topbar = new topbarUtil();
        $topbarDisplay['turtleacademy'] = false;
        $topbarDisplay['helpus'] = false;
        $topbarDisplay['playground'] = true;
        $topbarDisplay['forum'] = true;
        $topbarDisplay['news'] = true;
        $topbarDisplay['about'] = true;
        $topbarDisplay['sample'] = false;
        $signUpDisplay = false;
        $languagesDisplay = true;

        $language['en'] = "en";
        $language['ru'] = "ru";
        $language['es'] = "es";
        $language['zh'] = "zh";
        $language['he'] = "he"; 

        $topbar->printTopBar($rootDir, $class, $login, $topbarDisplay, $languagesDisplay
                , $signUpDisplay, $language, $empty = "");
        ?>
        <div class="container">
            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit" id="hero-top">
                <!--
                <div style="height:80px;"> <p style="float:left;"><img class='pull-right' src='files/turtles.png' alt=''/></p> </div>
                -->
                
                <h1><?php echo _("Turtle Academy") ; ?></h1>
                <h2 id="h2top"> the easy way to learn programming</h2>
                <p>Before People got board of start programming in Turtle academy you will see immidiate result for every action . </p>
                <p>No need to download a software just follow the lesson and start enjoying programming</p>
                <p><a class="btn primary large" href ="learn.php">Free Lessons </a> <a class="btn primary large">Sign In</a></p>
            </div>
            <div id="myCarousel" class="carousel slide">
                <!--
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Carousel items -->

                <div class="carousel-inner">
                    <div class="active item">
                        <div class="carousel"> 
                                <h1 id="h1quote"> "I got the passion for programming thanks to Turtle Academy"</h1>
                                <h3> Jin Sin Lin - China</h3>   
                        </div>        
                    </div>
                    <div class="item">
                        <div class="carousel"> 
                                <h1 id="h1quote"> "I want to do Mona"</h1>
                                <h3> Lucio - Israel</h3> 
                        </div>
                    </div>
                    <div class="item">
                        <div class="carousel"> 
                                <h1 id="h1quote"> "Burburi change my life"</h1>
                                <h3> Jin Sin Lin - China</h3>   
                        </div>
                    </div>
                </div>

            </div>
            <div class="">
                
            </div> 

                
            <!-- Example row of columns --> 
            <div class="row"> 
                <div class="span5">
                    <h2>Project goal <!--<img src='images/sample/icon1.png' alt=''/> --></h2>
                    <p>Our objective is teaching people around the world the programming basics in a fun way , everyone can start programming in his mother tongue </p>
                </div>
                <div class="span5">
                    <h2>Help needed <!--<img src='images/sample/icon2.png' alt=''/>--> </h2>
                    <p>In order to let people around the world the opportunity to learn programming we need volunteers who are willing to translate the website to more languages</p>
                    <p><a class="btn" href="#">View details &raquo;</a></p>
                </div>
            </div>



        </div> <!-- /container -->
        <?php echo $footer; ?>
    </div> <!-- /main -->
    <script> 
// Select language in main page
    $(document).ready(function() {
          selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $rootDir; ?>language/", "index.php" ,"en_US" ); 
            $('.carousel').carousel({
                 interval: 5000 
            })
            $("#myCarousel").carousel('cycle');
            $('#myCarousel').hover(function () {   
                 $(this).carousel('pause')
                 $(this).carousel(0)
            })
            
        });
        function showValue(h) {
                    console.log(h.name, h.value);
            }
            $("#tech").change(function() {
                    console.log("by jquery: ", this.value);
            })
                            
        </script>
</html> 