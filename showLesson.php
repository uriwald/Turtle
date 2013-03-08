<?php

$locale = "en_US";
if (isset($_GET['locale']))
    $locale    = $_GET['locale'];


if (!isset($_POST['locale']) && !isset($locale))
    echo "You will be able to see your lesson here by pressing show lesson button"; //Case of initial loading
else {
    
require_once("environment.php");
require_once("localization.php");
require_once("files/cssUtils.php");
require_once("files/utils/languageUtil.php");
include_once("files/inc/dropdowndef.php");
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
            ?>         
        </title>  
               
        <!--<script  type="text/javascript" src="ajax/libs/jquery/1.6.4/jquery.js"></script> <!--- equal to googleapis -->
        <script  type="text/javascript" src="<?php echo $jqueryui .  'js/jquery-ui-1.10.0.custom.js' ?>"></script> <!--- equal to googleapis -->
        <link rel='stylesheet' href='<?php echo $jqueryui .  'css/ui-lightness/jquery-ui-1.10.0.custom.css' ?>' type='text/css' media='all'/> 
        <!--
        <script  type="text/javascript" src="<?php echo $jqueryui .  'js/jquery-ui-1.10.0.custom.min.js' ?>"></script> 
        <link rel='stylesheet' href='<?php echo $jqueryui .  'css/ui-lightness/jquery-ui-1.10.0.custom.min.css' ?>' type='text/css' media='all'/> 
        <script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js'></script> 
        <script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js'></script>


        
        <script type="application/javascript" src="files/compat.js"></script> <!-- ECMAScript 5 Functions -->
        <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="files/turtle.js"></script> <!-- Canvas turtle -->
        <script type="application/javascript" src="files/jquery.tmpl.js"></script> <!-- jquerytmpl -->
        <script type="application/javascript" src="files/Gettext.js"></script> 
        <script type="application/javascript" src="files/interface.js?locale=<?php echo $locale ?>"></script> 
        <script type="application/javascript" src="files/jqconsole.js"></script> 
        <script type="application/javascript" src="files/logo.js"></script> 
        <script type="application/javascript" src="files/jquery.Storage.js"></script> 
        <!-- <link rel='stylesheet' href='./files/css/interface.css' type='text/css' media='all'/>  --> 
        <?php
        if (isset($_GET['locale']))
            $locale = $_GET['locale'];
        if (!isset($locale)) {
            $locale = "en_US";
        }
        $file_path = "locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";


        if (file_exists($file_path))
            echo $po_file;
        ?>
        <script type="text/javascript">
            var locale = "<?php echo $locale; ?>";
        </script>
        <script type="text/javascript"> 
        <?php  
            $m              = new Mongo();
            // select a database
            $db             = $m->$dbName;
            $lessons        =   $db->lessons_created_by_guest;
            $theObjId       =   new MongoId($_GET['objid']);
            $localPosted    =   $_GET['locale'];
            $cursor = $lessons->find(array("_id" => $theObjId));
            echo "var lessons = [";
                foreach ($cursor as $lessonStructure) {
                    //echo "cursorexist";
                    //  Unset the lesson ID
                    //   echo " some lessons found";
                    $lessonStructure['id'] = '' . $lessonStructure['_id'];
                    unset($lessonStructure['_id']);
                    // print_r($lessonStructure);
                    // If the requested language is in the current json collection
                    //echo "isset?  ".$lessonStructure['locale_' . $_GET[$localPosted]];
                    if (isset($lessonStructure['locale_' . $localPosted])) {
                        //  echo "isset ".$lessonStructure['locale_' . $_GET[$localPosted]];
                        $lessonStructure = $lessonStructure['locale_' . $localPosted];
                    }
                    if (isset($lessonStructure["steps"])) {
                        // echo "is set steps";
                        $lessonSteps = $lessonStructure["steps"];
                    }
                    //echo " printing lesson steps ";
                    //print_r($lessonSteps);
                    $showItem = true;
                    foreach ($lessonSteps as $key => $value) {
                        "enterLessonSteps";
                        //echo "Key = " . $key ;
                        // If we have locale for the current step we will set him
                        if (isset($lessonSteps[$key]['locale_' . $localPosted])) {
                            $lessonSteps[$key] = $lessonSteps[$key]['locale_' . $localPosted];
                        } else {
                            $showItem = false;
                        }
                        // unsetting the other locale values
                        foreach ($value as $kkey => $vvalue) {
                            //echo "Key = " . $kkey ;
                            if (strpos($kkey, 'locale') === 0) {
                                unset($lessonSteps[$key][$kkey]);
                            }
                        }
                    }
                    $lessonStructure["steps"] = $lessonSteps;
                    $finalTitle = $lessonStructure["title"];
                    //Now handling the title

                    $lessonTitles = $lessonStructure["title"];
                    foreach ($lessonTitles as $key => $value) {
                        //echo "@@@".$key;
                        if ($key == 'locale_' . $localPosted) {
                            $finalTitle = $lessonTitles[$key];
                        }
                    }
                    $lessonStructure["title"] = $finalTitle;

                    // cleanup extra locales
                    foreach ($lessonStructure as $key => $value) {
                        if (strpos($key, 'locale') === 0) {
                            unset($lessonStructure[$key]);
                        }
                    }
                   
                        echo json_encode($lessonStructure);
                        echo ",";
                    
                }
                echo "]";
            ?>  
        </script>    

<?php   
    cssUtils::loadcss($locale, "./files/css/interface");
?>    

    </head>
    <body> 
        <header id="turtletitle">
            <h1><img src="files/turtles.png" alt="צב במשקפיים">
                <?php
                echo _("Turtle Academy");
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
                    <canvas id="sandbox" width="660" height="350" class="ui-corner-all ui-widget-content">   
                        <span style="color: red; background-color: yellow; font-weight: bold;">
                            <?php
                            echo _("Your browser does not support canvas - an updated browser is recommended");
                            ?>                                      
                        </span>
                    </canvas>
                    <canvas id="turtle" width="660" height="350">   
                    </canvas>
                </div>

                <div id="console" class="ui-corner-all ui-widget-content"><!-- command box --></div>
            </div>

            <div id="accordion">
            </div>
            <div id="lessonnav">
                <?php
                    $lu = new languageUtil("turtleTestDb", "rtlLanguages");
                    $isRtlLocale = $lu->findIfLocaleExist($locale);
                    if ($isRtlLocale) {
                ?>  

                    <button id="nextlesson"> 
                    <?php
                    echo ($isRtlLocale) ? "&larr;" : "&rarr;";
                    echo _("Next");
                    ?> 
                    </button>
                    <button id="prevlesson">
                        <?php
                        echo ($isRtlLocale) ? "&rarr;" : "&larr;";
                        echo _("Prev");
                        ?>            
                    </button>
                        <?php
                    } else {
                        ?>     
                    <button id="prevlesson">
                    <?php
                    echo ($isRtlLocale) ? "&rarr;" : "&larr;";
                    echo _("Prev");
                    ?>            
                    </button>
                    <button id="nextlesson"> 
                        <?php
                        echo ($isRtlLocale) ? "&larr;" : "&rarr;";
                        echo _("Next");
                        ?> 
                    </button>

                        <?php
                    }
                    ?>

            </div>
        </div>
    </body>
</html>
<?php
} // End case of loading real lesson
?>