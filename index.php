
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
    require_once('files/openid.php');
    require_once('files/utils/topbarUtil.php');
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
        <!--<link href="<?php echo $rootDir; ?>twitter-bootstrap/twitter-bootstrap-v2/docs/assets/css/bootstrap.css" rel="stylesheet"> -->
        
        
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
        
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/turtle.js"></script> <!-- Canvas turtle -->
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
                , $signUpDisplay, $language, $empty = "" );
        ?>
        <div class="container">
            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit" id="hero-top">
                <!--
                <img class='pull-right' src='files/turtles.png' alt=''/>
                -->
              
                <h1 id="hero-main-title"><?php echo _("Turtle Academy") ; ?></h1> 
                <h2 id="hero-secondary-title"><?php echo _("the easy way to learn programming");?></h2>
                <p class="top"><?php echo _("With Turtle Academy is really easy to start creating amazing shapes using LOGO language");?></p>
                <p class="top"><?php echo _("Here are some examples how programming can be easy and fun");?></p>
                <div class='span14 example-continer'> 
                    <div class="span4 example" >
                        <p class="example-title"> <?php echo _("Create a spiral");?></p>
                        <p class="example-code"> for [i 10 100 10]     [fd :i rt 90] </p>
                        <div id="logo2"></div>
                        
                        <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>

                    </div>
                    <div class="span4 example" >
                        <p class="example-title"> <?php echo _("Cool flower");?></p>
                        <p class="example-code"> repeat 8 [rt 45 repeat 6 [repeat 90 [fd 1 rt 2] rt 90]] ht</p>
                        <div id="logo3"></div>
                        
                        <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>

                    </div>
                    <div class="span4 example" >
                        <p class="example-title"> <?php echo _("Crazy octagon");?></p>
                        <p class="example-code"> cs repeat 36 [ rt 10 repeat 8 [ fd 25 lt 45]] ht</p>
                        <div id="logo4"></div>
                        
                        <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>
                    </div>
                    <div class="span2">
                    </div>
                </div>
                <div id="start-logo" align="center">
                    <p class="top" id="start-logo-p"><?php echo _("Let's start having fun programming");?></p>
                    <div>
                        <p class="top"><a class="btn primary large" href ="learn.php">Free Lessons </a> <a class="btn primary large" href ="registration.php">Sign In</a></p>

                    </div>
                </div>
            </div>
            <div id="myCarousel" class="carousel slide">
                <!--
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Carousel items -->

                <div class="carousel-inner" id="crousel-quote">
                    <div class="active item">
                        <div class="carousel"> 
                                <h1 id="running-quote"> "I got the passion for programming thanks to Turtle Academy"</h1>
                                <h3 id="name-quote"> Jin Sin Lin - China</h3>   
                        </div>        
                    </div>
                    <div class="item">
                        <div class="carousel"> 
                                <h1 id="running-quote"> "I want to do Mona"</h1>
                                <h3 id="name-quote"> Lucio - Israel</h3> 
                        </div>
                    </div>
                    <div class="item">
                        <div class="carousel"> 
                                <h1 id="running-quote"> "Burburi change my life"</h1>
                                <h3 id="name-quote"> Jin Sin Lin - China</h3>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                
            </div> 

                
            <!-- Example row of columns --> 
            <div class="row span16" id="row-info"> 
                <div class="span1 row-info-div" style="width:30px">
                    <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>
                    <p></p>
                </div>
                <div class="span5 row-info-div">
                    <h2>Project goal <!--<img src='images/sample/icon1.png' alt=''/> --></h2>
                    <p>Our objective is to teach the programming principles in a fun and easy way and to bring programming to every kid in the world. </p>
                </div>
                <div class="span2 row-info-div">
                    <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>
                    <p></p>
                </div>
                <div class="span5 row-info-div">
                    <h2>Help needed <!--<img src='images/sample/icon2.png' alt=''/>--> </h2>
                    <p> In order to make programming approachable for more people  we need some volunteers who are willing to translate the site to their on native language</p>
                    <!--<p><a class="btn" href="#">View details &raquo;</a></p> -->
                </div>
            </div>
 
 

        </div> <!-- /container -->
        <?php echo $footer; ?>
    </div> <!-- /main -->
    <script> 
            function do_logo(id ,cmd) {
                $('#'+id).css('width', '200px').css('height', '200px').append('<canvas id="'+id+'c" width="200" height="200" style="position: absolute; z-index: 0;"></canvas>' +
                    '<canvas id="'+id+'t" width="200" height="200" style="position: absolute; z-index: 1;"></canvas>');
                var canvas_element2 = document.getElementById(id+"c");
                var turtle_element2 = document.getElementById(id+"t");
                var turtle2 = new CanvasTurtle(
                canvas_element2.getContext('2d'),
                turtle_element2.getContext('2d'),
                canvas_element2.width, canvas_element2.height);

                g_logo2 = new LogoInterpreter(turtle2, null);
                g_logo2.run(cmd);
            } 
            //do_logo ('logo1', 'fd 20');
            do_logo ('logo2', 'for [i 10 100 10] [fd :i rt 90]');
            do_logo ('logo3', 'cs repeat 8 [rt 45 repeat 6 [repeat 90 [fd 1 rt 2] rt 90]] ht');
            do_logo ('logo4', 'cs repeat 36 [ rt 10 repeat 8 [ fd 25 lt 45]] ht');
// Select language in main page
    $(document).ready(function() {
          selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $rootDir; ?>language/", "index.php" ,"en" ); 
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