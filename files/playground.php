
<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();

require_once("../environment.php");
require_once("../localization.php");
require_once("footer.php");
require_once("cssUtils.php");
require_once("utils/languageUtil.php");
require_once('utils/topbarUtil.php');
?>
<html>
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php
            echo _("Turtle Academy - learn logo programming in your browser");
            echo _(" free programming materials for kids");
        ?>  
        </title>      
        <?php
            require_once("utils/includeCssAndJsFiles.php"); 
        ?>   
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/js/langSelect.js"></script> <!-- Language select --> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/doc.css' type='text/css' media='all'/>
        <?php
        $file_path = "../locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='../locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
         echo "<script type='application/javascript' src='".$rootDir."files/jqconsole.js' ></script>\n" ;
        ?>        
        <script type="text/javascript">
            var locale = "<?php echo $locale; ?>";
        </script>
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/interface_plain.js?locale=<?php echo $locale ?>"></script> <!-- Interface scripts -->

        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/topbar.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/footer.css' type='text/css' media='all'/> 
        <?php
            cssUtils::loadcss($locale, $rootDir . "files/css/interface");
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
        <!-- End Google Analytics Tracking -->
        
        <style type="text/css">
            h1, h2, h3, h4, p { margin-bottom: 6pt; margin-top: 6pt; }
            body, p, h1, h2, h3 { font-family: sans-serif; }
            dl { margin-top: 6pt; }
            p, dt, dd, ol, li { font-size: 8pt; }
            code { font-family: monospace; }
            body
            {
                width: 270px;
                color: black;
                background-color: white;
            }
            #guide{
                position : absolute;
                right: 10px;
                top: 10px;
                width: 400px;
                padding: 5pt;
                padding-top: 0px;
                z-index: 10;
                color: black;
            }
            #guide_body{
                width: 400px;
                height: 450px;
                border: none;
            }
            .jqconsole {
                width: 950px;
            }
        </style>
    </head>
    <body> 
        <div id="guide">
            <a id="toggle_link" href="#" onclick="var gb = document.getElementById('guide_body'); var show = (gb.style.display === 'none'); gb.style.display = show ? '' : 'none';
                this.innerHTML = show ? 'hide' : 'show'; return false;">hide
            </a>
            <!-- Including all the Logo language menual -->
            <iframe frameborder="0" src="../files/lang.html" id="guide_body" style="">
            </iframe>  
        </div> 
        <div id="main" style="margin-left: 100px;">
        <?php
        //Printing the topbar menu
            $topbar = new topbarUtil();
            $topbar->printTopBar("playground"); 
        ?>
            <div id="headerplain" class="page-header" >
            <?php
                echo "<h1>";
                echo _("Logo play ground");
                echo "  <small>";
                echo _("Do whatever you desire");
                echo "</small></h1>";
            ?>   
            </div>
            <div id="logoerplain"> 
                <div id="displayplain"> 
                    <!-- <canvas id="sandbox" width="660" height="350" class="ui-corner-all ui-widget-content" style="position: absolute; z-index: 0;">-->
                    <canvas id="sandbox" width="970" height="500px" class="ui-corner-all ui-widget-content">   
                        <span style="color: red; background-color: yellow; font-weight: bold;">
                        <?php
                            echo _("TurtleAcademy learn programming for free");
                            echo _("Your browser is not supporting canvas");
                            echo _("We recoomnd you to use Chrome or Firefox browsers");
                        ?>                                      
                        </span> 
                    </canvas>
                    <canvas id="turtle" width="970" height="500px">   
                        <!-- drawing box -->
                    </canvas>
                </div>
                <div id="console" class="ui-corner-all ui-widget-content"><!-- command box --></div>
            </div>
        </div> <!-- End of main div -->
        <?php echo $footer; ?>
        <script>
            // Select language in main page
            $(document).ready(function() {                 
                selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $rootDir; ?>playground/" , "playground.php" ,"<?php echo substr($_SESSION['locale'], 0, 2) ?>" );
                //convert
                $("select").msDropdown();
                //createByJson();
                $("#tech").data("dd");             
            });
        </script>
    </body>
</html>