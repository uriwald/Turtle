
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
    <?php
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    require_once("files/utils/languageUtil.php");
    require_once ('files/openid.php');
    require_once ('files/utils/topbarUtil.php');

    ?>
<html dir="<?php echo $dir ?>" lang="<?php echo $locale_domain ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php
            echo _("Turtle Academy - learn logo programming in your browser");
            echo _(" free programming materials for kids");
        ?> 
        </title>
        <?php
        // Loading relevant js and css files
        require_once("files/utils/includeCssAndJsFiles.php"); 
        includeCssAndJsFiles::include_all_page_files("brainpop"); 
        require_once("files/utils/loadCrousel.php");
        
         echo "<script type='application/javascript' src='".$root_dir."files/jqconsole.js' ></script>\n" ;
         echo "<script type='application/javascript' src='".$root_dir."files/brainpop_interface.js?locale=".$locale_domain."'></script>\n" ;
        // Case user logged in we will clear the storage data and load it from db
        

        echo "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css'/>\n" ; 
        echo "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'/>\n" ; 
        
        echo "<link rel='stylesheet' href='".$root_dir."files/css/doc.css' type='text/css' media='all'/>\n" ; 
        //echo "<link rel='stylesheet' href='".$rootDir."files/css/interface.css' type='text/css' media='all'/>\n" ; 

        cssUtils::loadcss($locale_domain, $root_dir . "files/css/brainpop"); 
        ?>      
    </head> 
    <body> 
        <div id="main">
            <!-- Should be different for log in user and for a guest -->
            <?php
                //Not printing the  topbar menu for BrainPop
                //topbarUtil::printTopBar("learn");
            ?>

            <div id="header" >
                <div id="headprev"></div>
                <div id="headcar"></div> <!--direction: rtl;-->
                <div id="headnext"></div>
                <div id="progress">
                </div> 
            </div> 


            <div id="logoer"> 
                <div id="display"> 
                    <canvas id="sandbox" width="550" height="350" class="ui-corner-all ui-widget-content">   
                        <span style="color: red; background-color: yellow; font-weight: bold;">
                            <?php
                            echo _("TurtleAcademy learn programming for free");
                            echo _("Your browser is not supporting canvas");
                            echo _("We recoomnd you to use Chrome or Firefox browsers");
                            ?>                                      
                        </span>  
                    </canvas>
                    <canvas id="turtle" width="550" height="350">   
                        <!-- drawing box -->
                    </canvas>

                </div>

                <div id="console" class="ui-corner-all ui-widget-content"><!-- command box --></div>
            </div>
            <!-- Accordion div -->
            <div id="accorPlusNav">
                <div id="accordionLessonTitle">
                </div>
                <div id="accordion">
                </div>
                <div id="lessonnav">
                    <?php
                    //should be change to all rtl lnaguages
                    $lu = new languageUtil("turtleTestDb", "rtlLanguages");
                    $isRtlLocale = $lu->findIfLocaleExist($locale_domain);
                    // if($locale == 'he_IL')
                    if ($isRtlLocale) {
                        ?>  

                        <button id="nextlesson" class="btn"> 
                            <?php
                            //should be change to all rtl lnaguages
                            echo ($isRtlLocale) ? "&larr;" : "&rarr;";
                            echo _("Next");
                            ?> 
                        </button>
                        <button id="prevlesson" class="btn">
                            <?php
                            echo ($isRtlLocale) ? "&rarr;" : "&larr;";
                            echo _("Prev");
                            ?>            
                        </button>
                        <?php
                    } else {
                        ?>     
                        <button id="prevlesson" class="btn">
                            <?php
                            echo ($isRtlLocale) ? "&rarr;" : "&larr;";
                            echo _("Prev");
                            ?>            
                        </button>
                        <button id="nextlesson" class="btn"> 
                            <?php
                            //should be change to all rtl lnaguages
                            echo ($isRtlLocale) ? "&larr;" : "&rarr;";
                            echo _("Next");
                            ?> 
                        </button>

                        <?php
                    } //ending else
                    ?>
                </div> <!-- End Lesson + nav -->
            </div> <!-- End Accordion + nav -->
        </div> <!-- End of main div -->

        <script>
            // Select language in main page
            $(document).ready(function() { 
                
                //Js for selecting the language in the topbar dropdown menu
                selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $root_dir; ?>lang/" , "learn.php" ,"en" );
                
                //Enable saving canvas after drawing
                $('#savePic').click(function() {
                    var canvas = document.getElementById("sandbox"); 
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
                });
                //convert 
                $("select").msDropdown();
                //createByJson();
                $("#tech").data("dd");             
            });
        </script>
    </body></html>