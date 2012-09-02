<?php
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    
?>
<!DOCTYPE html>
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
        <script  type="text/javascript" src="files/lang/he.js"></script> <!--- Translation of commands used in logo.js-->
        
        
        <!--<script  type="text/javascript" src="ajax/libs/jquery/jquery.min.js"></script> <!--- equal to googleapis -->
        
        <script type="application/javascript" src="files/compat.js"></script> <!-- ECMAScript 5 Functions -->
        <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="files/turtle.js"></script> <!-- Canvas turtle -->
        <script type="application/javascript" src="files/jquery.tmpl.js"></script> <!-- jquerytmpl -->

        <?php
            if (!isset($_GET["locale"]))
                $locale = "en_US";
            else {
                $str = explode(".",$locale);
                $locale = $str[0];
            }
            $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
            $po_file =  "<link   rel='gettext' type='application/x-po' href='locale/".$locale."/LC_MESSAGES/messages.po'"." />";
            
            
            if ( file_exists($file_path))
                echo $po_file;
             
        ?>
        
        
        <!--<link   rel="gettext" type="application/x-po" href="locale/he_IL/LC_MESSAGES/messages.po" /> <!-- Static Loading hebrew definition -->
        <script type="application/javascript" src="readMongo.php?l=<?php echo $locale?>"></script> <!-- Lessons scripts -->
        <script type="application/javascript" src="files/Gettext.js"></script> <!-- Using JS GetText -->
        <script type="application/javascript" src="files/interface.js"></script> <!-- Interface scripts -->
        <script type="application/javascript" src="files/jqconsole.js"></script> <!-- Console -->
        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->
        <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./files/interface.css' type='text/css' media='all'/>
        <?php
             cssUtils::loadcss($locale, "./files/interface");
        /*
            $interface_ltr = "<link rel='stylesheet' href='./files/interface_ltr.css' type='text/css' media='all'/>";
            $interface     = "<link rel='stylesheet' href='./files/interface_rtl.css' type='text/css' media='all'/>"; 
            if ($locale != "he_IL" )
            {
                echo $interface_ltr;    
            }
            else
            {
                echo $interface;
            }
         * */
         
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
                    </canvas>
                </div>

                <div id="console" class="ui-corner-all ui-widget-content"></div>
            </div>

            <div id="accordion">
            </div>
            <div id="lessonnav">
                <?php
                     //should be change to all rtl lnaguages
                    if($locale == 'he_IL')
                    {
                ?>  
                    
                    <button id="nextlesson"> 
                    <?php
                        //should be change to all rtl lnaguages
                        echo ($locale == 'he_IL') ?  "&larr;" :  "&rarr;";     
                        echo _("Next");                   
                    ?> 
                    </button>
                    <button id="prevlesson">
                    <?php
                    echo ($locale == 'he_IL') ?  "&rarr;" :  "&larr;";  
                    echo _("Prev");                    
                    ?>            
                    </button>
                <?php
                    }else{
                ?>     
                    <button id="prevlesson">
                    <?php
                        echo ($locale == 'he_IL') ?  "&rarr;" :  "&larr;";  
                        echo _("Prev");                    
                    ?>            
                    </button>
                    <button id="nextlesson"> 
                    <?php
                        //should be change to all rtl lnaguages
                        echo ($locale == 'he_IL') ?  "&larr;" :  "&rarr;";     
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