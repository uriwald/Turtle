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
    require_once ('files/utils/topbarUtil.php');
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
              
            $topbar = new topbarUtil();
            $topbarDisplay['turtleacademy'] = true ;
            $topbarDisplay['helpus']        = false ;
            $topbarDisplay['playground']    = false ;
            $topbarDisplay['forum']         = false ;
            $topbarDisplay['news']          = false ;
            $topbarDisplay['about']         = false ; 
            $topbarDisplay['sample']        = false ;
            $signUpDisplay                  = true ;
            $languagesDisplay               = false ;
            $language['en'] = "en";$language['ru'] = "ru";
            $language['es'] = "es";$language['zh'] = "zh";$language['he'] = "he";
                
            $topbar->printTopBar($rootDir , $class , $login , $topbarDisplay , $languagesDisplay , $signUpDisplay , $language ,
                    $_SESSION); 
        ?> 
        ?> 
      
        <div class="container">
            <div class="content">
                <div class="page-header"> 
                    <h1>
                        <?php  echo _("Forums"); ?>  
                    </h1>  
                </div>
                <div class="row">
                    <div class="span10">
                        <!-- <div id="logo1"></div> -->
                        <h2>
                            <?php  echo _("Forums now avialable only in english"); ?> 
                        </h2> 
                        <div class='cleaner_h20'></div>
                        <p>
                            <?php
                                echo _("Please press the following link in order to post on the forum.");
                                echo "</br>";                                
                                echo _("A new window will be open");
                            ?>
                        </p>    
                        <a href="http://turtleacademy.forumtl.com/" target="_blank"><?php  echo _("Enter forums"); ?> </a>
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
