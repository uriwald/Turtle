
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
    $lang = substr($locale, 0, 2);
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
        $dd = new loadDd($rootDir, $env, "files/test/dd/");
        $jq = new loadJq($rootDir, $env);
        $bs = new loadBs($rootDir, $env, "files/bootstrap/");
        $lt = new loadTurtle($locale, $rootDir, $env);
        $dd->loadFiles(true, true, true, false, true); /* 182 min.js , dd.js , dd.css , skin2.css , flags.css */
        $jq->loadFiles(false, false, false, true, false, false); /* jquery-ui.min.js , alerts.js , tmpl.js , storage.js , custom.css */
        $bs->loadFiles(false, true, false, true); /* 1 bs.js ,2 bs_min.js ,3 bootstrap-carousel.js ,4 bs_all.css */
        $lt->loadFiles(true, false, false, false, false, false, true, false, false); /* 1 langSelect.js ,2 logo.js ,3 turtle.js ,4 floodfill.js ,5 canvas2image.js ,6 readMongo ,7 Gettext.js ,8 interface.js ,9 jqconsole.js */

        if (isset($_SESSION['username'])) {
            ?>   
            <script type="application/javascript" src="<?php echo $rootDir; ?>clearStorageData.php"></script>
            <?php
        }
        ?>

        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/index.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/topbar.css' type='text/css' media='all'/>

        <?php
        // Loading getText related files
        $file_path = "locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='" . $rootDir . "locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
        ?>       
        <script type="text/javascript">
            var locale = "<?php echo $locale; ?>";
        </script> 
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
        <!-- End Google Analytics Tracking --> 
        
    </head>
    <div id="index-main">
        <!-- <div id="index-main-wrapper"></div> 
         Should be different for log in user and for a guest -->
        <?php
        $class = ($locale == "he_IL" ? "pull-right" : "pull-left");
        $login = ($locale != "he_IL" ? "pull-right" : "pull-left");

        $topbar = new topbarUtil();
        $topbarDisplay['turtleacademy'] = false;
        $topbarDisplay['exercise'] = true;
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
            <div class="span14" id="page">
                <div id="first">
                    <h1>
                        We need your support
                    </h1>
                    <div>
                        <p>
                            Thanks for your willing to support turtleAcademy
                        </p>
                    </div>
                </div>
                <div id="second">
                    <h1>
                        We need your support
                    </h1>
                    <div>
                        <form>
                            <div>
                                <label>
                                    Name
                                </label>
                                <div>
                                    <input>
                                    </input>
                                </div> 
                            </div>
                            <div>
                                <label>
                                    Email
                                </label>
                                <div>
                                    <input>
                                    </input>
                                </div> 
                            </div>
                            <div>
                                <label>
                                    area
                                </label>
                                <div class="btn-group" data-toggle="buttons-radio">
                                    <label class="radio">
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                        Option one is this and that—be sure to include why it's great
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                        Option two can be something else and selecting it will deselect option one
                                    </label>
                                </div>
                            </div>
                            <div>

                                <div>
                                    <input type="submit">
                                    </input>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>






        <script> 
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
    </div>