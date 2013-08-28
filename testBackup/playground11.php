
<!DOCTYPE html>
<?php
    if(session_id() == '') 
        session_start();
    
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    require_once("files/utils/languageUtil.php");
    require_once('files/utils/topbarUtil.php');
    
    if ( !isset ($locale))
    {
        if (isset($_SESSION['locale']))
           $locale = $_SESSION['locale']; 
        else
        {
            $locale = "en_US";
            $_SESSION['locale'] = "en_US";
        }
    } 
    else
    {
        $_SESSION['locale'] =  $locale;  
    }

    
    $relPath    =   "files/bootstrap/twitter-bootstrap-sample-page-layouts-master/";
    $jqueryui   =   "/ajax/libs/jqueryui/1.10.0/";
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
        ?>   

        <!--<script  type="text/javascript" src="ajax/libs/jquery/jquery.min.js"></script> <!--- equal to googleapis v
         
        <script type="application/javascript" src="files/compat.js"></script> <!-- ECMAScript 5 Functions -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/turtle.js"></script> <!-- Canvas turtle -->
        
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/js/langSelect.js"></script> <!-- Language select --> 

        <?php
            $file_path = "../locale/".$locale."/LC_MESSAGES/messages.po"; 
            $po_file =  "<link   rel='gettext' type='application/x-po' href='locale/".$locale."/LC_MESSAGES/messages.po'"." />";       
            if ( file_exists($file_path))
                echo $po_file;            
        ?>        
        <script type="text/javascript">
                var locale = "<?php echo $locale; ?>";
        </script>
        <!--<link   rel="gettext" type="application/x-po" href="locale/he_IL/LC_MESSAGES/messages.po" /> <!-- Static Loading hebrew definition -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/Gettext.js"></script> <!-- Using JS GetText -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/interface_plain.js?locale=<?php echo $locale?>"></script> <!-- Interface scripts -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/jqconsole.js"></script> <!-- Console -->

        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/interface.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/topbar.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/footer.css' type='text/css' media='all'/> 
       <?php
             cssUtils::loadcss($locale, $rootDir . "files/css/interface");    
             cssUtils::loadcss($locale, $rootDir . "files/css/doc"); 
             cssUtils::loadcss($locale, $rootDir . "files/css/topbar"); 
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
                <iframe frameborder="0" src="../files/lang.html" id="guide_body" style="">
                
                </iframe>  

        </div> 
        <div id="main" style="margin-left: 100px;">
        <?php  
            $class = ($locale == "he_IL" ?  "pull-right" :  "pull-left");    
            $login = ($locale != "he_IL" ?  "pull-right" :  "pull-left");   
            
            $topbar = new topbarUtil();
            $topbarDisplay['turtleacademy'] = true ;
            $topbarDisplay['helpus']        = false ;
            $topbarDisplay['playground']    = false ;
            $topbarDisplay['forum']         = false ;
            $topbarDisplay['news']          = false ;
            $topbarDisplay['about']         = true ; 
            $topbarDisplay['sample']        = false ;
            $signUpDisplay                  = true ;
            $languagesDisplay               = true ;
            $language['en'] = "en";$language['ru'] = "ru";
            $language['es'] = "es";$language['zh'] = "zh";$language['he'] = "he";
                
            $topbar->printTopBar($rootDir , $class , $login , $topbarDisplay , $languagesDisplay , $signUpDisplay , $language ,
                    $_SESSION); 
        ?>
        <!--
        
            <div class="topbar" id="topbarMainDiv"> 
                <div class="fill" id="topbarfill">
                    <div class="container span16" id="topbarContainer"> 
                        <img class="brand" id="turtleimg" src="<?php echo $rootDir; ?>files/turtles.png" alt="צב במשקפיים">
                        
                        <ul class="nav" id="turtleHeaderUl"> 
                              <li><a href="<?php echo $rootDir; ?>index.php" ><?php echo _("TurtleAcademy");?></a></li> 
                              <li><a href="<?php echo $rootDir; ?>needed.php" ><?php echo _("Help Us");?></a></li>
                              <li><a href="<?php echo $rootDir; ?>project/doc" ><?php echo _("About");?></a></li>
                             <!--<li class="active"><a href="index.html"><?php echo _("Sample");?></a></li> 
                        </ul> 
                            
                        <form class="<?php  
                                            echo $class . " form-inline";                                
                                     ?>" action="" id="turtleHeaderLanguage">  
                            <select name="selectedLanguage" id="selectedLanguage" style="width:120px;"> 
                                <option value='en' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">English</option>
                                <option value='es' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Español</option>
                                <option value='he' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">עברית</option>
                                <option value='zh' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">中文</option>
                            </select>
                        </form>       
                        <?php
                            if (isset($_SESSION['username']))
                            {
                        ?>                       
                              <!--  <p class="pull-right">Hello <a href="#"> --
                                    <nav class="<?php echo $login ?>"  id="turtleHeaderLoggedUser">
                                        <ul class="nav nav-pills <?php echo $login ?>" id="loggedUserUl">
                                            
                                            <li style="padding: 10px 10px 11px;"> <?php echo _("Hello");?></li>
                                            <li class="cc-button-group btn-group"> 
                                                <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" >
                                                <?php
                                                    echo $_SESSION['username'];
                                                ?>
                                               
                                                </a>
                                                <ul class="dropdown-menu" id="ddmenu"role="menu" aria-labelledby="dLabel">
                                                    <li><a tabindex="-1" href="/users.php"   class="innerLink" id="help-nav"><?php echo _("My account");?></a></li>
                                                    <li><a tabindex="-1" href="/project/doc" class="innerLink" id="hel-nav"><?php echo _("Help");?></a></li>
                                                    <li><a href="<?php echo $rootDir; ?>logout.php" class="innerLink"><?php echo _("Log out");?></a></li>
                                                </ul>
                                            </li>
                                        </ul> 
                                    </nav>                                                                     

                        <?php
                            }
                            else
                            {
                        ?>       
                                <ul class="nav <?php echo $login ?>" id="turtleHeaderUl"> 
                                    <li><a href="<?php echo $rootDir; ?>registration.php" id="turtleHeaderUlLogin"><?php echo _("Login");?></a></li> 
                                    <li><a class='btn primary large' href="<?php echo $rootDir; ?>registration.php" ><?php echo _("Sign Up for free");?></a></li> 
                                </ul>                         
                         <?php
                            }
                         ?>
                    </div>
                </div>            
            </div> <!-- End of Top menu --> 
            <div id="headerplain" class="page-header" >
                <?php
                    echo "<h1>";
                        echo _("Logo play ground");
                        echo "  <small>";
                            echo _("Do whatever you desire");
                    echo "</small></h1>";
                 ?>   
                <!-- <h1> Logo play ground 
                <small>Do whatever you desire</small> </h1> --> 
                   
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
                                //    הדפדפן שלך אינו תומך בקנבס - מומלץ להשתמש בדפדפן עדכני יות                                
                            ?>                                      
                            </span> 
                    </canvas>
                    <!--<canvas id="turtle" width="660" height="350" style="position: absolute; z-index: 1;"> -->
                    <canvas id="turtle" width="970" height="500px">   
                        <!-- drawing box -->
                    </canvas>
                </div>

                <div id="console" class="ui-corner-all ui-widget-content"><!-- command box --></div>
             </div>
        </div>
        <?php echo $footer ;?>
        
        <script>
            /*
            $( init );

            function init() {
                $("#sandbox")[0].webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT); //Chrome
                $("#turtle")[0].webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT); //Chrome
                $("#sandbox")[0].mozRequestFullScreen(); //Firefox
                $("#turtle")[0].mozRequestFullScreen(); //Firefox
            }
            */
        // Select language in main page
      $(document).ready(function() {
                   
                    selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $rootDir; ?>playground/" , "playground.php" ,"<?php echo substr($_SESSION['locale'],0,2) ?>" );

                    $('#btnSaveUsrLessonData').click(function() { 
                        var lclStorageValue = ""
                        var isAnyDataToSave = false;
                        for (var i=0;i<8;i++)
                             for (var j=1;j<9;j++)
                            {
                                if ($.Storage.get("q(" + i +  ")" + j + "1" ))
                                {
                                    alert ("q(" + i +  ")" + j + "1");
                                    lclStorageValue += "q(" + i +  ")" + j + "1,";
                                    isAnyDataToSave =   true;
                                }
                            }
                        if (isAnyDataToSave)
                        {
                            $.ajax({
                                type : 'POST',
                                url : '/files/saveLocalStorage.php',
                                dataType : 'json',
                                data: {
                                    lclStoragevalues  :   lclStorageValue
                                },
                                success: function(data) { 
                                    var rdata;
                                    var i = 1;
                                } ,
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    alert('en error occured');
                                }
                            });
                        }
                        //if $.Storage.get("q(" + activeLesson + ")" + ($index +1)) == "true"}
                    });
	
                    //$("#ver").html(msBeautify.version.msDropdown);

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
        </script>
    </body>
</html>