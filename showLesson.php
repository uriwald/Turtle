<?php

if (!isset($_POST['locale']))
    echo "You will be able to see your lesson here by pressing show lesson button"; //Case of initial loading
else {
    

require_once("localization.php");
require_once("files/cssUtils.php");
require_once("files/utils/languageUtil.php");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
            <?php
            echo _("Turtle Academy - learn logo programming in your browser");
            ?>         
        </title>  
        <script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js'></script> 
        <script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js'></script>

        <script type="text/javascript" src="ajax/libs/jquery/1.6.4/jquery.js"></script> <!--- equal to googleapis -->
        <script type="text/javascript" src="ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script> <!--- equal to googleapis -->
        
        <script type="application/javascript" src="files/compat.js"></script> <!-- ECMAScript 5 Functions -->
        <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="files/turtle.js"></script> <!-- Canvas turtle -->
        <script type="application/javascript" src="files/jquery.tmpl.js"></script> <!-- jquerytmpl -->
        <script type="application/javascript" src="files/Gettext.js"></script> 
        <script type="application/javascript" src="files/interface.js?locale=<?php echo $locale ?>"></script> 
        <script type="application/javascript" src="files/jqconsole.js"></script> 
        <script type="application/javascript" src="files/logo.js"></script> 
        <script type="application/javascript" src="files/jquery.Storage.js"></script> 
        <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./files/css/interface.css' type='text/css' media='all'/>
        <?php
        if (isset($_POST['locale']))
            $locale = $_POST['locale'];
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
            /*
                        var lesson = new Array();
                        var allSteps = JSON.parse($.Storage.get("lessonStepsValues"));
                        var singleStep = new Array(new Array);
                        var steps   = new Array();
                        var precedence = 100;
                        var pending     = false;
                        var title       = "fake";
                        var i = 1
                        
                        var singleStepobj = new Object();
                        var allStepsobj    = new Object();

                        var singleStepfilter = new Array();
                        singleStepfilter[0] = "title";
                        singleStepfilter[1] = "solution";
                        singleStepfilter[2] = "hint";
                        singleStepfilter[3] = "explanation";
                        
                        var allStepfilter   = new Array();
                        allStepfilter[0] =  "title";
                        allStepfilter[1] = "precedence";
                        allStepfilter[2] = "pending";
                        allStepfilter[3] = "steps";
                         steps[0] = null ;
                        for (var i=1;i<allSteps.length;i++)
                            {
                                singleStep[0]['title'] = allSteps[i][0]; 
                                singleStep[0]['solution'] = allSteps[i][1]; 
                                singleStep[0]['hint'] = allSteps[i][2]; 
                                singleStep[0]['explanation'] = allSteps[i][3]; 
                                
                                singleStepobj.title = allSteps[i][0];
                                singleStepobj.solution = allSteps[i][2];
                                singleStepobj.hint = allSteps[i][3];
                                singleStepobj.explanation = allSteps[i][4];
                                //steps[i]    =  JSON.stringify(singleStepobj, singleStepfilter, "\t");
                                steps[i]    =  singleStep[0]; 
                            }
                        allStepsobj.title =   title;
                        allStepsobj.precedence =   precedence;
                        allStepsobj.pending   = pending;
                        allStepsobj.steps    = steps;
                        var lessons  =  JSON.stringify(allStepsobj,allStepfilter);
                        */
    
            <?php
            
                echo "var lessons = [";
                $steps = $_POST['steps'];
                $decodedStepValue = json_decode($steps);
                for ($i = 1; $i <= $_POST['numOfSteps']; $i += 1) {
                    $stepsArray = $decodedStepValue[$i];
      
                    $translatArray = array("title" => $stepsArray[0], "action" => $stepsArray[1], "solution" => $stepsArray[2],
                        "hint" => $stepsArray[3], "explanation" => $stepsArray[4]);
                    $lessonSteps[$i] = $translatArray;
                }
                $lessonjs["title"] = "";
                if (isset ($_POST['title']))
                     $lessonjs["title"] = $_POST['title'];
                $lessonjs["precedence"] = 100;
                $lessonjs["pending"] = false;
                $lessonjs["steps"] = $lessonSteps;
                echo json_encode($lessonjs);
                echo ",";
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