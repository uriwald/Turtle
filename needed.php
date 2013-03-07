<?php
    if(session_id() == '') 
        session_start();
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    include_once("files/inc/dropdowndef.php");
    include_once("files/inc/jquerydef.php");
    include_once("files/inc/boostrapdef.php");
 ?>
<!DOCTYPE html>
<html dir="ltr"> 
    <head> 
        <title> <?php  echo _("Project Documentation"); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/turtle.js"></script> <!-- Canvas turtle -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/Gettext.js"></script> <!-- Using JS GetText -->
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/topbar.css' type='text/css' media='all'/> 

        <?php   
        
            $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
            $po_file =  "<link   rel='gettext' type='application/x-po' href='".$rootDir."locale/".$locale."/LC_MESSAGES/messages.po'"." />";       
            if ( file_exists($file_path))
                echo $po_file;            
         
            if (!isset ($rootDir))
                $rootDir = "/";
            if (isset($_SESSION['locale']))
                $locale =   $_SESSION['locale'];
            if (!isset($locale))
                if (isset($_GET['locale']))
                    $locale = $_GET['locale'];
                else
                     $locale = "en_US";
            $localePage =   substr($locale, 0, -3); 
            require_once("localization.php");
            $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
            $po_file =  "<link   rel='gettext' type='application/x-po' href='".$rootDir."locale/".$locale."/LC_MESSAGES/messages.po'"." />";             
            if ( file_exists($file_path))
                echo $po_file;      
             cssUtils::loadcss($locale, $rootDir . "files/css/doc"); 
             cssUtils::loadcss($locale, $rootDir . "files/css/topbar");
        ?>
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
    <body>
        <?php  
            $class = ($locale == "he_IL" ?  "pull-right" :  "pull-left");    
            $login = ($locale != "he_IL" ?  "pull-right" :  "pull-left");    
        ?> 
        <div class="topbar" id="topbarMainDiv"> 
            <div class="fill" id="topbarfill">
                <div class="container span16" id="topbarContainer"> 
                    <img class="brand" id="turtleimg" src="<?php echo $rootDir ?>files/turtles.png" alt="צב במשקפיים">

                    <ul class="nav" id="turtleHeaderUl"> 
                            <li><a href="<?php echo $rootDir."lang/".$localePage; ?>" style="color:gray;" ><?php echo _("TurtleAcademy");?></a></li> 
                            <!--<li class="active"><a href="index.html"><?php echo _("Sample");?></a></li> -->
                    </ul> 
                    <?php
                        if (isset($_SESSION['username']))
                        {
                    ?>                       
                            <!--  <p class="pull-right">Hello <a href="#"> -->
                                <nav class="<?php echo $login ?>" style="width:200px;" id="turtleHeaderLoggedUser">
                                    <ul class="nav nav-pills <?php echo $login ?>" id="loggedUserUl">

                                        <li style="padding: 10px 10px 11px;"> <?php echo _("Hello");?></li>
                                        <li class="cc-button-group btn-group"> 
                                            <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" style="color:#ffffff; background-color: rgba(0, 0, 0, 0.5);" >
                                            <?php
                                                echo $_SESSION['username'];
                                            ?>
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu" id="ddmenu"role="menu" aria-labelledby="dLabel">
                                                <li><a tabindex="-1" href="/docs"   class="innerLink" id="help-nav"><?php echo _("My account");?></a></li>
                                                <li><a tabindex="-1" href="/docs" class="innerLink" id="hel-nav"><?php echo _("Help");?></a></li>
                                                <li><a href="logout.php" class="innerLink"><?php echo _("Log out");?></a></li>
                                            </ul>


                                        </li>
                                    </ul> 
                                </nav>                                                                     
                                </a>

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
            </div> <!-- Ending fill barf -->
        </div> <!-- Ending top bar -->
        <div class="container">
            <div class="content">
                <div class="page-header"> 
                    <h1>
                        <?php  echo _("Help Us"); ?>  
                    </h1>  
                </div>
                <div class="row">
                    <div class="span10">
                        <!-- <div id="logo1"></div> -->
                        <h2>
                            <?php  echo _("Translate"); ?> 
                        </h2>
                        <div class='cleaner_h20'></div>
                        <p>
                            <?php
                                echo _("TurtleAcademy aspires to be availabe for kids all around the world. ");
                                echo _("if you wish to help translating the project please contact us.");
                            ?>
                        </p>    
                        <div id="logo2"></div>
                        <h2>     
                            <?php
                                echo _("Add some content");
                            ?> 
                        </h2>
                        <div class='cleaner_h20'></div>
                        <p>
                            <?php
                                echo _("Did you like the lessons and you feel you can contribute more knowledge. ");
                                echo _("Please register and create more lesson in your own native language.");
                                echo _("after adding the lessons they can be avialable for kids all around the world."); 
                            ?>
                        </p>  
                        <h2>     
                            <a href="mailto:support@turtleacademy.com?subject=Helping TurtleAcademy project" target="_blank">Contact Us</a> 
                        </h2>
                        
                   </div> <!-- end of span10 -->
              </div> <!-- end of row -->              
            </div> <!-- end of content -->
        </div> <!-- End of container --> 
 <script>
        // Select language in main page
      $(document).ready(function() {
                    $('.dropdown-toggle').dropdown();
                    $.Storage.set("locale","<?php echo $_SESSION['locale']; ?>");
                    //Show selected lanugage from dropdown                   
                    try { 
                            var pages = $("#selectedLanguage").msDropdown({on:{change:function(data, ui) {
                                    var val = data.value;
                                    if(val!="")
                                           window.location = "<?php echo $rootDir; ?>lang/" + val; 
                            }}}).data("dd");
                                                        var pagename    = document.location.pathname.toString();
                            pagename        = pagename.split("/");
                            var pageIndex   = pagename[pagename.length-1];
                            if (pageIndex == "" || pageIndex == "index.php" )
                                 pageIndex   = "en";
                            pages.setIndexByValue(pageIndex);
                            //$("#ver").html(msBeautify.version.msDropdown);
                    } catch(e) {
                            //console.log(e);	
                    } 
	
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

<?php

?>
