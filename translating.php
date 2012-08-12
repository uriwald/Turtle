<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require_once("localization.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
        </title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <script  type="text/javascript" src="ajax/libs/jquery/jquery.min.js"></script> <!--- equal to googleapis -->
        <script  type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script  type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
        <script  type="text/javascript" src="alerts/jquery.alerts.js"></script>
        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->
        <script type="application/javascript" src="files/js/lesson.js"></script> <!-- lessonFunctions -->     
        <link rel='stylesheet' href='./files/lessons.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./alerts/jquery.alerts.css' type='text/css' media='all'/>
        
        <?php
                $languageGet = "ltranslate";
                $localetr = "en_US";
                if (isset($_GET[$languageGet]))
                    $localetr = $_GET[$languageGet];
            $file_path = "locale/".$localetr."/LC_MESSAGES/messages.po";
            $po_file =  "<link   rel='gettext' type='application/x-po' href='locale/".$localetr."/LC_MESSAGES/messages.po'"." />";        
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
        require_once ("files/lessonsUtil.php");
        $m = new Mongo();
// select a database
        $db = $m->turtleTestDb;
// select a collection (analogous to a relational database's table)
        $lessons = $db->lessons;
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
            if ($doTranslate) {
                $localStepsTranslate = $lu->getStepsByLocale($localePrefix . $localeTranslate);
                $lessonFinalTitleTranslate = $lu->getTitleByLocale($localePrefix . $localeTranslate);
            }
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
            $baseInputText = "<div> <label class='lessonlables'> %%a: </label> <textarea class='lessonInfoElement'  $disabled type='text'  name='%%b' id='%%b' placeholder='$step %%a'>%%c</textarea> </div>";

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
                var lessonStepValuesStorage = new Array(new Array());
                $.Storage.set('lessonStepsValues',JSON.stringify(lessonStepValuesStorage, null, 2));
                $.Storage.set('lessonStepsValuesTranslate',JSON.stringify(lessonStepValuesStorage, null, 2));
                $.Storage.set("active-step" , "1");
                $.Storage.set("lesson-total-number-of-steps" ,"0");
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
    //TODO Need to fill the lesson elements in case the translation is exist

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
        /**
        else {
            foreach ($localSteps as $step) {
               ?>
                <script type='text/javascript'>         
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
              } //end of foreach loop in case there are no translation steps
        }
         ***/ 
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
                <div>

                    <div class="leftLessonElem">
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
                        <input type="text" name="lessonTitlet"  id="lessonTitlet" class="lessonInput" placeholder="Lesson Title"/>


                    </div>
                </div>   
                </br>
    <?php
    echo "<div id='lessonStep'>";
    // echo "<lable id='lessonStepLabel'> Lesson Step Title </lable>";
    echo "<div id='stepNev'>";
    echo "<lable class='lessonHeader'>lesson Steps </lable>";
    echo "<ul id='lessonStepUl'>";
    echo "</ul>";
    //Inserting the step div

    echo "</div>";
    echo "</div>";
    ?>
                <div class="leftLessonElem"> 
                    <lable class='lessonlables' > Title :  </lable> 
                    <textarea type="text" disabled='disabled'  name="title" id="title" placeholder="Step Title" class="lessonInfoElement" >
                    </textarea>
                <?php
                printElement($i, false, null, false);
                ?>
                    <lable class='lessonlables' > Explanation </lable> 
                    </br>
                    <textarea type="text"  name="explanation" id="explanation" class="expTxtErea"></textarea>
                </div>

                <div class="rightLessonElem"> 
                    <!-- here I should do something equal to left for translating -->
                    <lable class='lessonlables' > 
                        <?php 
                             // echo ($localetr == 'he_IL') ?  "&larr;" :  "&rarr;";     
                             echo _("Title");        
                        ?> 
                    
                    </lable> 
                    <textarea type="text"  name="title1" id="title1" placeholder="Step Title" class="lessonInfoElement" >
                    </textarea>
                    <?php
                    printElement($i, false, null, true);
                    ?>
                    <lable class='lessonlables' >                         
                        <?php     
                             echo _("Explanation");        
                        ?> 
                    </lable> 
                    </br>
                    <textarea type="text"  name="explanation1" id="explanation1" class="expTxtErea1"></textarea>

                </div>     
                <div class="downButton">
                    <input type="button" id="btnSaveLesson" class="lessonInputButton" name="formSave" value="Save" />
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
    echo "<div id='lessonStep'>";
    //    echo "<lable id='lessonStepLabel'> Lesson Step Title </lable>";
    echo "<div id='stepNev'>";
    echo "<lable class='lessonHeader'>lesson Steps </lable>";
    echo "<ul id='lessonStepUl'>";
    echo "</ul>";
    echo "</div>";
    //Inserting the step div
    echo "</div>";
    echo "</div>";
    ?>
                <div class="leftLessonElem"> 
                    <lable class='lessonlables' > Title :  </lable> 
                    <textarea type="text"  name="title" id="title" placeholder="Step Title" class="lessonInfoElement">
                    </textarea>
                <?php
                printElement($i, false, null, true);
                ?>
                </div> 
                <div class="rightLessonElem">
                    <lable class='lessonlables' > Explanation : </lable>
                    </br>
                    <textarea type="text"  name="explanation" id="explanation" class="expTxtErea"></textarea>
                </div>     
                <div>
                    <input type="button" id="btnSaveLesson" class="lessonInputButton" name="formSave" value="Save" />
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
