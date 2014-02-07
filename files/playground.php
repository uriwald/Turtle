
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
        <link rel='stylesheet' href='<?php echo $root_dir; ?>files/css/doc.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='<?php echo $root_dir; ?>files/css/playground.css' type='text/css' media='all'/>
        <?php
            bindtextdomain("messages", "../locale");
            textdomain("messages");
            $file_path = $site_path . "/locale/" . $locale_domain . "/LC_MESSAGES/messages.po";
            $po_file = "<link   rel='gettext' type='application/x-po' href='" . $file_path . "'" . " />";
            if (file_exists($file_path))
            {
                echo "<script> alert('$file_path')</script>\n" ;
            } 
            echo "<script type='application/javascript' src='".$root_dir."files/jqconsole.js' ></script>\n" ;
         
        ?>        
        <script type="text/javascript">
            var locale = "<?php echo $locale_domain; ?>"; 
        </script>
        <script type="application/javascript" src="<?php echo $root_dir; ?>files/interface_plain.js?locale=<?php echo $locale_domain ?>"></script> <!-- Interface scripts -->
        <?php
            cssUtils::loadcss($locale_domain, $root_dir . "files/css/interface");
        ?>             
        <link rel='stylesheet' href='<?php echo $root_dir; ?>files/css/playground.css' type='text/css' media='all'/>

    </head>
    <body> 
        <div id="guide">
            <a id="toggle_link" href="#" onclick="var gb = document.getElementById('guide_body'); var show = (gb.style.display === 'none'); gb.style.display = show ? '' : 'none';
                this.innerHTML = show ? 'hide' : 'show'; return false;">hide
            </a>
            <!-- Including all the Logo language menual -->
            <iframe frameborder="0" src="<?php echo $root_dir; ?>files/lang.html" id="guide_body" style="">
            </iframe>  
        </div> 
        <div id="main" style="margin-left: 100px;">
        <?php
            //Printing the topbar menu
            topbarUtil::print_topbar("playground");
        ?>
            <div id="headerplain" class="page-header" >
            <?php
                echo "<h1 dir=' $dir'>";
                echo _("Logo play ground");
                echo "  <small>";
                echo _("Do whatever you desire");
                echo "</small></h1>";
            ?>   
            </div>
            <div id="logoerplain"> 
                <div id="displayplain"> 
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
        <script>
            // Select language in main page
            $(document).ready(function() {                 
                selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $root_dir; ?>playground/" , "playground.php" ,"<?php echo substr($_SESSION['locale'], 0, 2) ?>" );
                //convert
                $("select").msDropdown();
                //createByJson();
                $("#tech").data("dd");             
            });
        </script>
    </body>
</html>