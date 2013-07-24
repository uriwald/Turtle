
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
            require_once("files/utils/loadDd.php");
            require_once("files/utils/loadJq.php");
            require_once("files/utils/loadBs.php"); 
            require_once("files/utils/loadTurtle.php");
            $dd = new loadDd($rootDir , $env , "files/test/dd/"); 
            $jq = new loadJq($rootDir , $env );
            $bs = new loadBs($rootDir , $env , "files/bootstrap/");
            $lt = new loadTurtle($locale , $rootDir , $env  );
             $dd->loadFiles(true, true, true, false, true); /* 182 min.js , dd.js , dd.css , skin2.css , flags.css*/
            $jq->loadFiles(false , false , false , true , false); /* jquery-ui.min.js , alerts.js , tmpl.js , storage.js , custom.css */
            $bs->loadFiles(false , true , true , true); /* 1 bs.js ,2 bs_min.js ,3 bootstrap-carousel.js ,4 bs_all.css */
            $lt->loadFiles(true,true,true,false,false,false,true ,false ,false); /* 1 langSelect.js ,2 logo.js ,3 turtle.js ,4 floodfill.js ,5 canvas2image.js ,6 readMongo ,7 Gettext.js ,8 interface.js ,9 jqconsole.js */
             
            if (isset($_SESSION['username'])) {
                ?>   
            <script type="application/javascript" src="<?php echo $rootDir; ?>clearStorageData.php"></script>
            <?php
        }
        ?>

        
        
        <?php
        $file_path = "locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='" . $rootDir . "locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
        ?>       
        <script type="text/javascript">
            var locale = "<?php echo $locale; ?>";
        </script>

        <?php
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
        <!-- <div id="index-main-wrapper"></div> 
         Should be different for log in user and for a guest -->
        <?php
        $class = ($locale == "he_IL" ? "pull-right" : "pull-left");
        $login = ($locale != "he_IL" ? "pull-right" : "pull-left");

        $topbar = new topbarUtil();
        $topbarDisplay['turtleacademy'] = false;
        $topbarDisplay['exercise']      = true;
        $topbarDisplay['helpus']        = false;
        $topbarDisplay['playground']    = true;
        $topbarDisplay['forum']         = true; 
        $topbarDisplay['news']          = true; 
        $topbarDisplay['about']         = true;
        $topbarDisplay['sample']        = false;
        $signUpDisplay                  = false;
        $languagesDisplay               = true;

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
                <h2 id="hero-secondary-title"><?php echo _("The easy way to learn programming");?></h2>
                <p class="top"><?php echo _("Turtle Academy makes it surprisingly easy to start creating amazing shapes using the LOGO language");?></p>
                <p class="top"><?php echo _("Here are some examples for easy and fun programming");?></p>
                <div class='span14 example-continer'>
                    <div class="span4 example" >
                        <p class="example-title"> <?php echo _("Create a Spiral");?></p>
                        <p class="example-code"> <?php echo _("for [i 10 100 10]     [fd :i rt 90] ht");?> </p>
                        <div id="logo2"></div>
                        
                        <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>

                    </div>
                    <div class="span4 example" >
                        <p class="example-title"> <?php echo _("Cool flower");?></p>
                        <p class="example-code"> <?php echo _("repeat 8 [rt 45 repeat 6 [repeat 90 [fd 1 rt 2] rt 90]] ht"); ?></p>
                        <div id="logo3"></div>
                        <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>

                    </div>
                    <div class="span4 example" >
                        <p class="example-title"> <?php echo _("Crazy octagon");?></p>
                        <p class="example-code"> <?php echo _("cs repeat 36 [ rt 10 repeat 8 [ fd 25 lt 45]] ht");?></p>
                        <div id="logo4"></div>
                        
                        <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>
                    </div>
                    <div class="span2">
                   </div>
                </div>
                <div id="start-logo" align="center">
                    <p class="top" id="start-logo-p"><strong><?php echo _("Let's start having fun programming");?></strong></p>
                    <div id="goto-buttons">
                        <p class="top"><a class="btn primary large indbtn" href ="<?php echo $rootDir ;?>learn.php"><?php  echo _("Free Lessons");?> </a> <a class="btn primary large indbtn" href ="registration.php"><?php  echo _("Sign In");?></a></p>

                    </div> 
                </div>
            </div>
            <div id="myCarousel" class="carousel slide">
                <div class="carousel-inner" id="crousel-quote">
                    <div class="active item">
                        <div class="carousel"> 
                            <div>
                                <h1> "<?php echo _("I got the passion for programming thanks to Turtle Academy");?>"</h1>
                            </div>
                            <h3> Jin Sin Lin - China</h3>   
                        </div>        
                    </div>
                    <div class="item">
                        <div class="carousel"> 
                            <div>
                                <h1> "<?php echo _("Really easy to use")?>"</h1>
                            </div>
                                <h3> Lucio - Israel</h3> 
                        </div>
                    </div>
                    <div class="item">
                        <div class="carousel"> 
                            <div>
                                <h1 id="running-quote"> "<?php echo _("My son is enjoying studying programming"); ?>"</h1>
                            </div>
                                <h3> Matt Hok - England</h3>   
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
                <div class="span9 row-info-div">
                    <h2><?php echo _("Project goal"); ?> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>
                    <p><?php echo  _("Our objective is to teach programming principles in a fun and easy way making programming an accessible competancy to every child in the world") ; echo "."; ?></p>
                    <p><?php echo  _("In the (quite near) future everything we will do will require basic programming abilities, and therefore it is important to learn this skill and learn to like it");?></p>
                    <p><?php echo  _("Making programming visual provides very quick rewards for the efforts, making it perfect for young children who often have trouble setting long term goals")?> </p>
                </div>

                <div class="span5 row-info-div">
                    <h2><?php echo _("Want to help"); echo "?"; ?> <!--<img src='images/sample/icon2.png' alt=''/>--> </h2>
                    <p> <?php echo _("In order to make programming approachable for more people we need volunteers to translate the site to their own native languages");?>.</p>
                    <!--<p><a class="btn" href="#">View details &raquo;</a></p> -->
                </div>
            </div>
 
 

        </div> <!-- /container -->
        <?php //echo $footer; ?>

    </div> <!-- /main -->
    <!-- style="position: absolute; z-index: 0; style="position: absolute; z-index: 1;"" -->
    <script> 
            function do_logo(id ,cmd) {
                $('#'+id).css('width', '200px').css('height', '160px').append('<canvas id="'+id+'c" width="200" height="160" ></canvas>' +
                    '<canvas id="'+id+'t" width="200" height="160" ></canvas>');
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
            do_logo ('logo2', 'for [i 10 100 10] [fd :i rt 90] ht');
            do_logo ('logo3', 'cs pu setxy -20 -20 pd repeat 8 [rt 45 repeat 6 [repeat 90 [fd 1 rt 2] rt 90]] ht');
            do_logo ('logo4', 'cs pu setxy 10 0 pd repeat 36 [ rt 10 repeat 8 [ fd 25 lt 45]] ht');
// Select language in main page
    $(document).ready(function() {
          selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $rootDir; ?>language/", "index.php" ,"en" ); 
            $('.carousel').carousel({
                 interval: 15000 
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