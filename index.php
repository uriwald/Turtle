
<!DOCTYPE html>
<?php
    if(session_id() == '') 
        session_start();
    //if (!isset($_SESSION['username']))
    //        $_SESSION['username'] = "lucio";
    if ( !isset ($locale))
    {
        $locale = "en_US";
        $_SESSION['locale'] = "en_US";
    }                 
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    require_once("files/utils/languageUtil.php");
    $relPath    =   "files/bootstrap/twitter-bootstrap-sample-page-layouts-master/";
    $ddPath     =   "files/test/dd/";
    $jqueryui   =   "ajax/libs/jqueryui/1.10.0/";
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
     <!-- Adding the dropdown dd directory related -->
        <script src="<?php echo $ddPath . 'js/jquery/jquery-1.8.2.min.js'?>"></script> 
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/dd.css'?>" />
        <script src="<?php echo $ddPath . 'js/msdropdown/jquery.dd.min.js'?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/skin2.css' ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath .  'css/msdropdown/flags.css' ?>" /> 
     <!-- Finish the dropdown dd directory related -->

               
        <!--<script  type="text/javascript" src="ajax/libs/jquery/1.6.4/jquery.js"></script> <!--- equal to googleapis -->
        <script  type="text/javascript" src="<?php echo $jqueryui .  'js/jquery-ui-1.10.0.custom.js' ?>"></script> <!--- equal to googleapis -->
        <link rel='stylesheet' href='<?php echo $jqueryui .  'css/ui-lightness/jquery-ui-1.10.0.custom.css' ?>' type='text/css' media='all'/> 
        <!--
        <script  type="text/javascript" src="<?php echo $jqueryui .  'js/jquery-ui-1.10.0.custom.min.js' ?>"></script> 
        <link rel='stylesheet' href='<?php echo $jqueryui .  'css/ui-lightness/jquery-ui-1.10.0.custom.min.css' ?>' type='text/css' media='all'/> 
        -->
        <!--<script  type="text/javascript" src="ajax/libs/jquery/jquery.min.js"></script> <!--- equal to googleapis v
         
        <script type="application/javascript" src="files/compat.js"></script> <!-- ECMAScript 5 Functions -->
        <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="files/turtle.js"></script> <!-- Canvas turtle -->
        <script type="application/javascript" src="files/jquery.tmpl.js"></script> <!-- jquerytmpl -->
        <!--<script src="<?php echo $relPath . 'scripts/jquery.min.js' ?>"></script>-->
        <?php
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
        <!-- Disable script when working on local mode without internet 
        <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css' type='text/css' media='all'/> 
        -->
        <link rel='stylesheet' href='./files/css/interface.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='./files/css/footer.css' type='text/css' media='all'/> 
        <link href="<?php echo $relPath . 'styles/bootstrap.min.css' ?>" rel="stylesheet"> 
        <!--<script type="application/javascript" src="<?php echo $relPath . 'scripts/bootstrap-dropdown.js' ?>"></script>  Bootstaps drop down -->
        <script type="application/javascript" src="files/bootstrap/js/bootstrap.js"></script> <!-- Storage -->
        <script type="application/javascript" src="files/bootstrap/js/bootstrap.min.js"></script> <!-- Storage --> 
       <?php
             cssUtils::loadcss($locale, "./files/css/interface");       
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
    </head>
    <body> 
        <?php  
            $class = ($locale == "he_IL" ?  "pull-right" :  "pull-left");    
            $login = ($locale != "he_IL" ?  "pull-right" :  "pull-left");    
        ?>
        <div id="main">
            <!-- Should be different for log in user and for a guest -->
            <div class="topbar" style="position: static;">
                <div class="fill">
                    <div class="container span16" > 
                        <img class="brand" id="turtleimg" src="files/turtles.png" alt="צב במשקפיים">
                        
                        <ul class="nav" id="turtleHeaderUl"> 
                              <li><a href="index.php" style="color:gray;" ><?php echo _("TurtleAcademy");?></a></li> 
                             <!--<li class="active"><a href="index.html"><?php echo _("Sample");?></a></li> -->
                        </ul>
                            
                        <form class="<?php  
                                            echo $class . " form-inline";                                
                                     ?>" action="" id="turtleHeaderLanguage">  
                            <select name="selectedLanguage" id="selectedLanguage" style="width:120px;">
                                <option value='index.php' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">English</option>
                                <option value='es.php' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Español</option>
                                <option value='he.php' data-image="Images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">עברית</option>
                                <option value='zh.php' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">中文</option>
                            </select>
                        </form>       
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
                                                    <li><a tabindex="-1" href="users.php"   class="innerLink" id="help-nav"><?php echo _("My account");?></a></li>
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
                                    <li><a href="registration.php" style="color:gray;" ><?php echo _("Login");?></a></li> 
                                </ul>                         
                         <?php
                            }
                         ?>
                    </div>
                </div>
                
            </div>
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
                <?php
                if (isset($_SESSION['username']))
                    {
                ?>
                <div id="console" class="ui-corner-all ui-widget-content"><button class="btn" id="btnSaveUsrLessonData"> save data </button></div>
                <?php
                    }
                ?>
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
                    
                    <button id="nextlesson" class="btn"> 
                    <?php
                        //should be change to all rtl lnaguages
                       // echo ($locale == 'he_IL') ?  "&larr;" :  "&rarr;";     
                        echo ($isRtlLocale) ?  "&larr;" :  "&rarr;"; 
                        echo _("Next");                   
                    ?> 
                    </button>
                    <button id="prevlesson" class="btn">
                    <?php
                    //echo ($locale == 'he_IL') ?  "&rarr;" :  "&larr;";  
                    echo ($isRtlLocale) ?  "&rarr;" :  "&larr;";  
                    echo _("Prev");                    
                    ?>            
                    </button>
                <?php
                    }else{
                ?>     
                    <button id="prevlesson" class="btn">
                    <?php
                       // echo ($locale == 'he_IL') ?  "&rarr;" :  "&larr;";  
                        echo ($isRtlLocale) ?  "&rarr;" :  "&larr;";  
                        echo _("Prev");                    
                    ?>            
                    </button>
                    <button id="nextlesson" class="btn"> 
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
                                            window.location = val;
                            }}}).data("dd");
                            var pagename    = document.location.pathname.toString();
                            pagename        = pagename.split("/");
                            var pageIndex   = pagename[pagename.length-1];
                            if (pageIndex == "")
                                pageIndex   = "index.php";
                            pages.setIndexByValue(pageIndex);
                            //$("#ver").html(msBeautify.version.msDropdown);
                    } catch(e) {
                            //console.log(e);	
                    }
                    // Selecting language button
                    try {
                            var pages = $("#pages").msDropdown({on:{change:function(data, ui) {
                            var val = data.value;
                            if(val!="")
                                    window.location = val;
                    }}}).data("dd");

                            var pagename = document.location.pathname.toString();
                            pagename = pagename.split("/");
                            pages.setIndexByValue(pagename[pagename.length-1]);
                            $("#ver").html(msBeautify.version.msDropdown);
                    } catch(e) {
                            //console.log(e);	
                    }
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
                                url : 'files/saveLocalStorage.php',
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
    </body></html>