
<!DOCTYPE html>
<?php
    if(session_id() == '') 
        session_start();
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    require_once("files/utils/languageUtil.php");
    
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php
            echo _("Turtle Academy - learn logo programming in your browser");
//        אקדמיית הצב - למד תכנות לוגו היישר מתוך הדפדפן                
            $currentFile = $_SERVER["PHP_SELF"];
            $parts = Explode('/', $currentFile);
            $currentPage = $parts[count($parts) - 1];
        ?>
           
        </title>    

        <script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js'></script> 
        <script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js'></script>
       
        <script  type="text/javascript" src="ajax/libs/jquery/1.6.4/jquery.js"></script> <!--- equal to googleapis -->
        <script  type="text/javascript" src="ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script> <!--- equal to googleapis -->
       <!---  <script  type="text/javascript" src="files/lang/he.js"></script> Translation of commands used in logo.js-->
        
        
        <!--<script  type="text/javascript" src="ajax/libs/jquery/jquery.min.js"></script> <!--- equal to googleapis -->
        
        <script type="application/javascript" src="files/compat.js"></script> <!-- ECMAScript 5 Functions -->
        <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="files/turtle.js"></script> <!-- Canvas turtle -->
        <script type="application/javascript" src="files/jquery.tmpl.js"></script> <!-- jquerytmpl -->

        <?php
           // if (!isset($_GET["locale"]))
                    if ( !isset ($locale))
               ///          $locale = $_SESSION['locale'];
               ///     else
                    {
                        //echo $locale;
                         $locale = "en_US";
                    }
                    /*
            else {
                $str = explode(".",$locale);
                $locale = $str[0];
            }
                     * 
                     */
            $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
            $po_file =  "<link   rel='gettext' type='application/x-po' href='locale/".$locale."/LC_MESSAGES/messages.po'"." />";
            
            
            if ( file_exists($file_path))
                echo $po_file;
             
        ?>
        
        
        <script type="text/javascript">
                var locale = "<?php echo $locale; ?>";
        </script>
        <!--<link   rel="gettext" type="application/x-po" href="locale/he_IL/LC_MESSAGES/messages.po" /> <!-- Static Loading hebrew definition -->
        <script type="application/javascript" src="readMongo.php?locale=<?php echo $locale?>"></script> <!-- Lessons scripts -->
        <script type="application/javascript" src="files/Gettext.js"></script> <!-- Using JS GetText -->
        <script type="application/javascript" src="files/interface.js?locale=<?php echo $locale?>"></script> <!-- Interface scripts -->
        <script type="application/javascript" src="files/jqconsole.js"></script> <!-- Console -->
        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->
        <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./files/css/interface.css' type='text/css' media='all'/>
        <?php
             cssUtils::loadcss($locale, "./files/css/interface");       
        ?>    
        <script type="application/javascript"> <!-- Google Analytics Tracking -->

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
    <body> 
        

        <header id="title">
            <h1><img src="files/turtles.png" alt="צב במשקפיים">
            <?php
                 echo _("Turtle Academy");
            //        אקדמיית הצב                    
             ?> 
                    <a href=he.php><img src='Images/flags/Israel.png'  title='עברית' class='flagIcon' /></a>
                    <a href=index.php> <img src='Images/flags/UnitedStates.png'  title='English' class='flagIcon' /></a> 
                    <a href=zh.php> <img src='Images/flags/China.png'  title='中文' class='flagIcon' /></a>  
                    <a href=es.php> <img src='Images/flags/Argentina.png'  title='Español' class='flagIcon' /></a>  
            </h1>
        </header>
        <div id="main">
            <div id="header" class="menu" >
                <div id="progress">
                </div>
            </div>
            <div id="logoer"> 
                <div id="display"> 
                    <!-- <canvas id="sandbox" width="660" height="350" class="ui-corner-all ui-widget-content" style="position: absolute; z-index: 0;">-->
                    <canvas id="sandbox" width="660" height="350" class="ui-corner-all ui-widget-content">   
                            <span style="color: red; background-color: yellow; font-weight: bold;">
                            <?php
                                echo _("Your browser does not support canvas - an updated browser is recommended");
                                //    הדפדפן שלך אינו תומך בקנבס - מומלץ להשתמש בדפדפן עדכני יות                                
                            ?>                                      
                            </span>
                    </canvas>
                    <!--<canvas id="turtle" width="660" height="350" style="position: absolute; z-index: 1;"> -->
                    <canvas id="turtle" width="660" height="350">   
                        <!-- drawing box -->
                    </canvas>
                </div>

                <div id="console" class="ui-corner-all ui-widget-content"><!-- command box --></div>
            </div>

            <div id="accordion">
            </div>
            <div id="lessonnav">
                <?php
                     //should be change to all rtl lnaguages
                    $lu = new languageUtil("turtleTestDb" , "rtlLanguages");
                    $isRtlLocale = $lu->findIfLocaleExist($locale);
                   // if($locale == 'he_IL')
                    if ($isRtlLocale)
                    {
                ?>  
                    
                    <button id="nextlesson"> 
                    <?php
                        //should be change to all rtl lnaguages
                       // echo ($locale == 'he_IL') ?  "&larr;" :  "&rarr;";     
                        echo ($isRtlLocale) ?  "&larr;" :  "&rarr;"; 
                        echo _("Next");                   
                    ?> 
                    </button>
                    <button id="prevlesson">
                    <?php
                    //echo ($locale == 'he_IL') ?  "&rarr;" :  "&larr;";  
                    echo ($isRtlLocale) ?  "&rarr;" :  "&larr;";  
                    echo _("Prev");                    
                    ?>            
                    </button>
                <?php
                    }else{
                ?>     
                    <button id="prevlesson">
                    <?php
                       // echo ($locale == 'he_IL') ?  "&rarr;" :  "&larr;";  
                        echo ($isRtlLocale) ?  "&rarr;" :  "&larr;";  
                        echo _("Prev");                    
                    ?>            
                    </button>
                    <button id="nextlesson"> 
                    <?php
                        //should be change to all rtl lnaguages
                        echo ($isRtlLocale) ?  "&larr;" :  "&rarr;";   
                        //echo ($locale == 'he_IL') ?  "&larr;" :  "&rarr;"; 
                        echo _("Next");                   
                    ?> 
                    </button>

                <?php
                    } //ending else
                ?>
                  
            </div>
        </div>
        
        <!--
        <footer id="footer">
            &copy; TurtleAcademy, <a id="doc" title="תעוד הפרוייקט" href="doc.html">
            <?php
                 echo _("project doc");
            //        תעוד הפרוייקט                     
             ?> 
                                 
            </a>
            <div id="langicons">
                <a href="<?php echo $currentPage ?>?locale=he_IL"><img src="Images/flags/il.png"  title="עברית" /></a>
                <a href="<?php echo $currentPage ?>"> <img src="Images/flags/us.png"  title="English" /></a>              
            </div>    
        </footer>
        -->
        <?php echo $footer ?>

    </body></html>