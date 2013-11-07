<!--
To change this template, choose Tools | Templates
and open the template in the editor.
--> 
<?php
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        </title>      
        <script  type="text/javascript" src="ajax/libs/jquery/jquery.min.js"></script> <!--- equal to googleapis -->
        <script  type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script  type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
        <script  type="text/javascript" src="alerts/jquery.alerts.js"></script>
        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->
        <script type="application/javascript" src="files/js/lesson.js"></script> <!-- lessonFunctions -->  
        <script type="application/javascript" src="files/Gettext.js"></script> <!-- Using JS GetText -->
        <link rel='stylesheet' href='./files/css/lessons.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./alerts/jquery.alerts.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./files/bootstrap/css/bootstrap.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./files/bootstrap/css/bootstrap-responsive.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./files/bootstrap/css/bootstrap-responsive.css' type='text/css' media='all'/>       
        <script type="application/javascript" src="files/Gettext.js"></script>
        
        <?php
                $languageGet = "ltranslate";
                $localetr = "en_US";
                if (isset($_GET[$languageGet]))
                    $localetr = $_GET[$languageGet];
            $file_path = "locale/".$localetr."/LC_MESSAGES/messages.po";
            $po_file =  "<link   rel='gettext' type='application/x-po' href='locale/".$localetr."/LC_MESSAGES/messages.po'"." />";        
            //echo $po_file; 
            if ( file_exists($file_path))
                echo $po_file;
             
        ?>
    </head>
    <body>
        <header id="titleHeader">
            <h1><img src="files/turtles.png" alt="צב במשקפיים">
                <?php
                echo _("Turtle Academy - Translate a lesson");
                //        אקדמיית הצב                    
                ?>
            </h1>
        </header>
        <?php
        //session_start();
        require_once ("files/utils/lessonsUtil.php");
        $m = new Mongo();
// select a database
        $db = $m->$dbName;
// select a collection (analogous to a relational database's table)
        $lessons = $db->$dbLessonCollection;
        $locale = "en_US";
        $localeFullName = "";
        $localeTranslate = "";
        $localeFullNameTranslate = "";
        $languageGet = "lfrom";
        $languageGetTranslate = "ltranslate";
        $doTranslate = false;

        $localePrefix = "locale_";

        $lessonFinalTitle = "";
        if (isset($_GET[$languageGet]))
            $locale = $_GET[$languageGet];

        $localeFullName = "locale_" . $locale;

        if (isset($_GET[$languageGetTranslate])) {
            $localeTranslate = $_GET[$languageGetTranslate];
            $doTranslate = true;
            $localeFullNameTranslate = "locale_" . $localeTranslate;
        }

//If we are in existing lesson we will enter editing mode 
        if (isset($_GET['lesson'])) {
            $lu = new lessonsUtil($locale, "locale_", $lessons, $_GET['lesson']);
            $theObjId = new MongoId($_GET['lesson']);
            $cursor = $lessons->findOne(array("_id" => $theObjId));
            $localSteps = $lu->getStepsByLocale($localePrefix . $locale);
            $lessonFinalTitle = $lu->getTitleByLocale($localePrefix . $locale);
            $lessonPrecedence    = 75;
            $lessonTurtleId      = 80; //Default value 
            if ($doTranslate) {
                $localStepsTranslate = $lu->getStepsByLocale($localePrefix . $localeTranslate);
                $lessonFinalTitleTranslate = $lu->getTitleByLocale($localePrefix . $localeTranslate);
            }
            $lessonPrecedence   = $lu->getPrecedence();
            $lessonTurtleId     = $lu->getTurtleId();
            
        }

        function printElement($i, $flag, $step, $istranslate) {
            if ($flag) {
                $action = $step["action"];
                $solution = $step["solution"];
                $hint = $step["hint"];
            } else {
                $action = "";
                $solution = "";
                $hint = "";
            }
            $disabled = '';
            if (!$istranslate)
                $disabled = "disabled='disabled'";

            $step =  _("Step") ;
            //TODO get list of rtl country from db
            $rtl             = "";
            $rtlLabel        = "" ;
            if ($istranslate)
            {
                
                //Todo if $localeTranslate in a list of given rtl list
                if ($_GET["ltranslate"] == "he_IL")
                {
                    $rtl = "textAreaRtl";
                    $rtlLabel = "lessonlabelsRtl";
                } 
            }  
            $baseInputText = "<div> <label class='lesson-label $rtlLabel translating-label'> %%a </label> <textarea class='lessonInfoElement $rtl input-xlarge'  $disabled type='text'  name='%%b' id='%%b' placeholder='$step %%a'>%%c</textarea> </div>";

            $toReplace = array("%%a", "%%b", "%%c");
            if (!$istranslate) {
                $replaceWithAction = array("Action ", "action", $action);
                $replaceWithSolution = array("Solution ", "solution", $solution);
                $replaceWithHint = array("Hint ", "hint", $hint);
            } else {
                $replaceWithAction = array(_("Action"), "action1", $action);
                $replaceWithSolution = array(_("Solution"), "solution1", $solution);
                $replaceWithHint = array( _("Hint") , "hint1", $hint);
            }
            $elementAction = str_replace($toReplace, $replaceWithAction, $baseInputText);
            $elementSolution = str_replace($toReplace, $replaceWithSolution, $baseInputText);
            $elementHint = str_replace($toReplace, $replaceWithHint, $baseInputText);
            echo $elementAction;
            echo $elementSolution;
            echo $elementHint;
        } // end of print elements
        function printLessonSteps()
             {
                       echo "<div id='lessonStep'>";
                            echo "<div id='stepNev'>";
                                echo "-- ";
                                echo "<h3 class='muted'>Lesson Steps" ;
                                if (isset($_GET['lesson']))    
                                    echo " ↓(please choose step to edit)";
                                echo "</h3>";
                                echo "<ul id='lessonStepUl' class=' nav nav-pills'>";
                                echo "</ul>";
                        //Inserting the step div
                           echo "</div>"; //End of stepNev div
                       echo "</div>"; //End of lessonStep div
             }
        ?>
        <?php
        $i = 1; //Set default value to 1 in case there are no steps
        if (isset($cursor["steps"]) && count($cursor["steps"]) > 0) {
            $i = 0;
            //Init the loacl Storage
            ?>
            <script type='text/javascript'>
                $.Storage.remove("lessonStepsValues");
                $.Storage.remove("lessonStepsValuesTranslate");
                $.Storage.remove("active-step-num");
                $.Storage.remove("lesson-total-number-of-steps");
                $.Storage.remove("active-step");
                $.Storage.remove("precedence");
                $.Storage.remove("turtleId");
                $.Storage.remove("collection-name");

               
                var lessonStepValuesStorage = new Array(new Array());
                $.Storage.set('lessonStepsValues',JSON.stringify(lessonStepValuesStorage, null, 2));
                $.Storage.set('lessonStepsValuesTranslate',JSON.stringify(lessonStepValuesStorage, null, 2));
                $.Storage.set("active-step" , "1");
                $.Storage.set("lesson-total-number-of-steps" ,"0");
                $.Storage.set("precedence", "<?php echo intval($lessonPrecedence)?>");
                $.Storage.set("turtleId",   "<?php echo intval($lessonTurtleId)?>");
                $.Storage.set("collection-name" ,"<?php echo $dbLessonCollection ?>");
            </script>
    <?php
    foreach ($localSteps as $step) {
        //$i++;
        //var_dump($step);
        //var_dump($step["$localeFullName"]);
        ?>
                <script type='text/javascript'>
                    //Here I am parsing the response from the ajax request regarding loading an existing lesson
                    var stepNumber = parseInt($.Storage.get("lesson-total-number-of-steps")) + 1;
                    $.Storage.set("lesson-total-number-of-steps" , stepNumber.toString());                                 
                    var stepExplanation = <?php echo json_encode($step["explanation"]); ?>;
                    var stepTitle= <?php echo json_encode($step["title"]); ?>;
                    var stepAction = <?php echo json_encode($step["action"]); ?>;
                    var stepSolution = <?php echo json_encode($step["solution"]); ?>;
                    var stepHint = <?php echo json_encode($step["hint"]); ?>;
                                         
                    $.Storage.set("lesson-total-number-of-steps" , stepNumber.toString());
                                                             
                    var fullStep = new Array();        
                    fullStep[0] = stepTitle;
                    fullStep[1] = stepAction;
                    fullStep[2] = stepSolution;
                    fullStep[3] = stepHint;
                    fullStep[4] = stepExplanation;                  
                                
                    //adding the step
                    window.addStepVar(stepNumber , fullStep , false , "lessonStepsValues");         
                                       
                </script>
        <?php
    } //End of for each loop
    if ($doTranslate) {
        //var_dump($localStepsTranslate);
        if ($localStepsTranslate != null) {
            foreach ($localStepsTranslate as $step) {
                $i++;
                //echo $localeFullName;
                //var_dump($step);
               // var_dump($step["$localeFullName"]);

               // echo json_encode($step["$localeFullName"]["explanation"]);
                ?>
                        <script type='text/javascript'>
                            //Here I am parsing the response from the ajax request regarding loading an existing lesson
                            //var stepNumber = parseInt($.Storage.get("lesson-total-number-of-steps")) + 1;
                            //$.Storage.set("lesson-total-number-of-steps" , stepNumber.toString());
                                               

                            var stepExplanation = <?php echo json_encode($step["explanation"]); ?>;
                            var stepTitle= <?php echo json_encode($step["title"]); ?>;
                            var stepAction = <?php echo json_encode($step["action"]); ?>;
                            var stepSolution = <?php echo json_encode($step["solution"]); ?>;
                            var stepHint = <?php echo json_encode($step["hint"]); ?>;       
                            //$.Storage.set("lesson-total-number-of-steps" , stepNumber.toString());

                            var fullStep = new Array();        
                            fullStep[0] = stepTitle;
                            fullStep[1] = stepAction;
                            fullStep[2] = stepSolution;
                            fullStep[3] = stepHint;
                            fullStep[4] = stepExplanation;                  
                            //adding the step
                            window.addStepVar(stepNumber , fullStep , false , "lessonStepsValuesTranslate");         
                        </script>
                <?php
            } //End of for each loop
        } // end of if there are translation steps
        else { // no translation steps
            ?>
                    <script type='text/javascript'>
                        var maxSteps = $.Storage.get("lesson-total-number-of-steps");
                        for (i=0; i<maxSteps; i++)
                        {
                            var fullStep = new Array();        
                            fullStep[0] = "";
                            fullStep[1] = "";
                            fullStep[2] = "";
                            fullStep[3] = "";
                            fullStep[4] = "";                  
                            //adding the step
                            window.addStepVar(stepNumber , fullStep , false , "lessonStepsValuesTranslate");      
                        }   
                    </script>
            <?php
        }
    } //End of If
    ?>  
            <div id="stepSection" style="margin-bottom:4px;" class="stepsSection">
                    <?php
                        $rtl = "";
                        $rtlLabel = "";
                        //TODO if $localeTranslate in a list of given rtl list
                        if ($localeTranslate == "he_IL")
                        {
                            $rtl = "textAreaRtl";
                            $rtlLabel = "lessonlabelsRtl";
                        } 
                          
                    ?>
                <div>

                    <div class="leftLessonElem translationdiv">
                        <lable class="lessonHeader"> Lesson Title : </lable> 
                        <input type="text" name="lessonTitle"  id="lessonTitle" class="lessonInput" placeholder="Lesson Title"/>
                        <! Object ID: --!> 
                        <input type="text" name="ObjId" style="display:none" id="lessonObjectId" class="lessonInput" value="<?php
                        if (isset($cursor["_id"]))
                            echo $cursor["_id"]; else {
                            echo "";
                        }
                        ?>"/>
                    </div>  
                    <div class="rightLessonElem rightLessonTitleElem">
                        <lable class="lessonHeader"> Lesson Title : </lable> 
                        <input type="text" name="lessonTitlet"  id="lessonTitlet" class="lessonInput <?php echo $rtlLabel ?>" placeholder="Lesson Title"/>


                    </div>
                </div>   
                </br>
    <?php
    printLessonSteps();
    /*
    echo "<div id='lessonStep'>";
    // echo "<lable id='lessonStepLabel'> Lesson Step Title </lable>";
    echo "<div id='stepNev'>";
    echo "<lable class='lessonHeader'>lesson Steps </lable>";
    echo "<ul id='lessonStepUl'>";
    echo "</ul>";
    //Inserting the step div

    echo "</div>";
    echo "</div>"
     */
    ?>
                <div class="leftLessonElem translationdiv"> 
                    <lable class='lesson-label translating-label' > Title :  </lable> 
                    <textarea type="text" disabled='disabled'  name="title" id="title" placeholder="Step Title" class="lessonInfoElement input-xlarge input-xlarge" >
                    </textarea>
                <?php
                printElement($i, false, null, false);
                ?>
                    <lable class='lesson-label translating-label' > Explanation </lable> 
                    </br>
                    <textarea type="text"  name="explanation" id="explanation" class="expTxtErea"></textarea>
                </div>

                <div class="rightLessonElem translationdiv"> 
                    <lable class='lesson-label <?php echo $rtlLabel ?> translating-label' > 
                        <?php 
                             // echo ($localetr == 'he_IL') ?  "&larr;" :  "&rarr;";     
                            echo _("Title");        
                        ?> 
                    
                    </lable> 
                    <textarea type="text"  name="title1" id="title1" placeholder="Step Title" class="lessonInfoElement <?php echo $rtl ?> input-xlarge" >
                    </textarea>
                    <?php
                    printElement($i, false, null, true);
                    ?> 
                    <lable class='lesson-label <?php echo $rtlLabel ?> translating-label' >                         
                        <?php     
                             echo _("Explanation");        
                        ?> 
                    </lable> 
                    </br>
                    <textarea type="text"  name="explanation1" id="explanation1" class="expTxtErea1"></textarea>

                </div>     
                <div class="downButton">
                    <input type="button" id="btnSaveLessonTranslate" class="lessonInputButton" name="formSave" value="Save" />
                    <a href="<?php echo $rootDir."files/translation/lesson/lessonsTransReportPage.php?locale=".$localetr?>" id="redirectLessonReportPage"> Back to admin page </a>
                </div>
            </div>  
            <script type='text/javascript'>
                                                    
                //Print Nav  
                window.createStepNavVar();
                            
                window.showFirstStepIfExist('lessonStepsValues');
                window.showFirstStepIfExist('lessonStepsValuesTranslate');
                        
            </script>
    <?php
} //end of if
else {
    ?>
            <div id="stepSection" style="margin-bottom:4px;" class="stepsSection">
                <div>

                    <lable class="lessonHeader"> Lesson Title : </lable>



                    <input type="text" name="lessonTitle"  id="lessonTitle" class="lessonInput" placeholder="Lesson Title"/>
                    <! Object ID: --!> 
                    <input type="text" name="ObjId" style="display:none" id="lessonObjectId" class="lessonInput" value="<?php
    if (isset($cursor["_id"]))
        echo $cursor["_id"]; else {
        echo "";
    }
    ?>"/>


                </div>  
                </br>

    <?php
    printLessonSteps();
    ?>
                <div class="leftLessonElem translationdiv"> 
                    <lable class='lesson-label translating-label' > Title :  </lable> 
                    <textarea type="text"  name="title" id="title" placeholder="Step Title" class="lessonInfoElement input-xlarge">
                    </textarea>
                <?php
                printElement($i, false, null, true);
                ?>
                </div> 
                <div class="rightLessonElem translationdiv">
                    <lable class='lesson-label translating-label' > Explanation : </lable>
                    </br>
                    <textarea type="text"  name="explanation" id="explanation" class="expTxtErea"></textarea>
                </div>     
                <div>
                    <input type="button" id="btnSaveLessonTranslate" class="lessonInputButton" name="formSave" value="Save" />
                    <input type="button" id="btnDeleteLesson" class="lessonInputButton" name="formDelete" value="Delete Lesson" />
                </div>

            </div>     
    <?php
} //end of else
?>
        <div id="message" style="display: none;">
            <div id="waiting" style="display: none;">
                Please wait<br />
            </div>
    </body>
</html>
