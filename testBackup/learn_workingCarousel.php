
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<?php
    if(session_id() == '') 
        session_start();
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
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    require_once("files/utils/languageUtil.php");
    require_once ('files/openid.php');
    require_once ('files/utils/topbarUtil.php');
    $relPath    =   "files/bootstrap/twitter-bootstrap-sample-page-layouts-master/";
    $jqueryui   =   "ajax/libs/jqueryui/1.10.0/";
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
        /*
             include_once("files/inc/dropdowndef.php");
             include_once("files/inc/jquerydef.php");
             include_once("files/inc/boostrapdef.php"); */
            require_once("files/utils/loadDd.php");
            require_once("files/utils/loadJq.php");
            require_once("files/utils/loadBs.php");
            require_once("files/utils/loadTurtle.php");
            $dd = new loadDd($root_dir , $env , "files/test/dd/"); 
            $jq = new loadJq($root_dir , $env );
            $bs = new loadBs($root_dir , $env , "files/bootstrap/");
            $lt = new loadTurtle($locale , $root_dir , $env  );
            $dd->load_files(true, true, true, false, true); /* 182 min.js , dd.js , dd.css , skin2.css , flags.css*/
            $jq->loadFiles(true, false, true, true, true, false , true); /* jquery-ui.min , alerts.js , tmpl.js , storage.js , custom.css */
            $bs->load_fiels(false , true ,true , true); /*bs.js , bs_min.js ,bootstrap-carousel.js , bs_all.css */
            $lt->load_files(); /*langSelect.js , logo.js , turtle.js , floodfill.js , canvas2image.js , readMongo , Gettext.js , interface.js , jqconsole.js */
             
            
             if (isset($_SESSION['username']))
                { 
        ?>   
             <script type="application/javascript" src="<?php echo $root_dir; ?>clearStorageData.php"></script>
             <link rel='stylesheet' href='<?php echo $root_dir; ?>files/css/topbar.css' type='text/css' media='all'/>
             <link rel='stylesheet' href='<?php echo $root_dir; ?>files/css/doc.css' type='text/css' media='all'/>
             <?php
                } 
              ?> 
        <?php
            $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
            $po_file =  "<link   rel='gettext' type='application/x-po' href='".$root_dir."locale/".$locale."/LC_MESSAGES/messages.po'"." />";       
            if ( file_exists($file_path))
                echo $po_file;            
        ?>       
        <script type="text/javascript">
                var locale = "<?php echo $locale; ?>";
        </script>
        <script type="application/javascript" src="<?php echo $root_dir; ?>readMongo.php?locale=<?php echo $locale?>"></script> <!-- Lessons scripts -->
     
 <?php
        /*
            if (($env == "local"))
            {
          
         ?>
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/jqconsole.js"></script> <!-- Console -->
        <?php
            }  else {
               //Need to fix location problemm
               echo "<script src='http:////cdnjs.cloudflare.com/ajax/libs/jq-console/2.7.7/jqconsole.min.js'>"; 
           }
         * */

        ?>
        
        <!-- Adding new boostrap for crusel --> 
       
   
         
        <!-- End of adding boostrap for crusel -->
        <link rel='stylesheet' href='<?php echo $root_dir; ?>files/css/interface.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='<?php echo $root_dir; ?>files/css/topbar.css' type='text/css' media='all'/> 
       <?php
             cssUtils::loadcss($locale, $root_dir . "files/css/interface");    
             //cssUtils::loadcss($locale, $rootDir . "files/css/doc"); 
             //cssUtils::loadcss($locale, $rootDir . "files/css/topbar"); 
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
            <?php
                $topbar = new topbarUtil();
                $topbarDisplay['turtleacademy'] = false ;
                $topbarDisplay['exercise']      = false ;  
                $topbarDisplay['helpus']        = false ;
                $topbarDisplay['playground']    = true ;
                $topbarDisplay['forum']         = true ;
                $topbarDisplay['news']          = true ;
                $topbarDisplay['about']         = true ;
                $topbarDisplay['sample']        = false ;
                $signUpDisplay                  = true ;
                $languagesDisplay               = true ;
                $language['en'] = "en";$language['ru'] = "ru";
                $language['es'] = "es";$language['zh'] = "zh";$language['he'] = "he";
                
                $topbar->printTopBar($root_dir , $class , $login , $topbarDisplay , $languagesDisplay 
                        , $signUpDisplay ,$language, $empty = "");
            ?>

            <div id="header" class="carousel slide menu" >
                <div id="progress">
                </div>
                
                
            </div>

            <div id="logoer"> 
                <div id="display"> 
                    <!-- <canvas id="sandbox" width="660" height="350" class="ui-corner-all ui-widget-content" style="position: absolute; z-index: 0;">-->
                    <canvas id="sandbox" width="660" height="350" class="ui-corner-all ui-widget-content">   
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
                    <canvas id="turtle" width="660" height="350">   
                        <!-- drawing box -->
                    </canvas>
                    
                </div>

                <div id="console" class="ui-corner-all ui-widget-content"><!-- command box --></div>
                <?php echo $footer; ?>
             </div>
            <div id="accorPlusNav">
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
            </div> <!-- End Accordion + nav -->
        </div> <!-- End of main div -->
                
        <script>
        // Select language in main page
      $(document).ready(function() { 
          selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $root_dir; ?>lang/" , "learn.php" ,"en" );

                    $('#savePic').click(function() {
                         var canvas = document.getElementById("sandbox");
                         //document.getElementById("theimage").src = canvas.toDataURL();
                         Canvas2Image.saveAsPNG(canvas);
                    });
                    
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
    </body></html>