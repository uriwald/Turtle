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
             cssUtils::loadcss($locale, $rootDir . "files/css/doc"); 
             cssUtils::loadcss($locale, $rootDir . "files/css/topbar");
        ?>
    </head>
    <body>
        <?php  
                        $topbar = new topbarUtil();
            
            $topbarDisplay = array (
                "turtleacademy" => true,
                "exercise" => true,
                "helpus" => false,
                "playground" => false,
                "forum" => false,
                "news" => false,
                "about" => true,
                "sample" => false
            );
 
            $signUpDisplay = true;
            $languagesDisplay = false;

            $language = array(
                "en" => "en_US",
                "ru" => "ru_RU",
                "es" => "es_AR",
                "zh" => "zh_CN",
                "he" => "he_IL"
            );
 
                
            $topbar->printTopBar($rootDir , $topbarDisplay , $languagesDisplay , $signUpDisplay , $language ); 
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
