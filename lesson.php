<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
    session_start();
    (isset($_SESSION['Admin']) && $_SESSION['Admin'] == true) ? $show = true : $show = false ;
    if ($show == false)
        (isset($_SESSION['Guest']) && $_SESSION['Guest'] == true) ? $show = true : $show = false ;
?>

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
        
        <link rel='stylesheet' href='./files/css/lessons.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./alerts/jquery.alerts.css' type='text/css' media='all'/>   
    </head>
    <body>
        <header id="titleHeader">
            <h1><img src="files/turtles.png" alt="צב במשקפיים">
            <?php
                 echo _("Turtle Academy - Create a lesson");
            //        אקדמיית הצב                    
             ?> 
            </h1>
        </header>
        <?php
        //session_start();
        require_once ("files/utils/lessonsUtil.php");
        
        $m = new Mongo();
// select a database
        $db = $m->turtleTestDb;
// select a collection (analogous to a relational database's table)
        $lessons = $db->lessons;
        $locale = "en_US";
        $languageGet = "l";
        $localePrefix = "locale_";
        $lessonFinalTitle = "";
        if (isset($_GET[$languageGet]))
            $locale = $_GET[$languageGet];

//If we are in existing lesson we will enter editing mode 
        if (isset($_GET['lesson'])) {
            $lu                 = new lessonsUtil($locale, "locale_", $lessons, $_GET['lesson']);
            $theObjId           = new MongoId($_GET['lesson']);
            $cursor             = $lessons->findOne(array("_id" => $theObjId));
            $localSteps         = $lu->getStepsByLocale($localePrefix . $locale);
            $lessonFinalTitle   = $lu->getTitleByLocale($localePrefix . $locale);
            $lessonPrecedence   = $lu->getPrecedence();
            //echo $lessonFinalTitle;
        }
        

        function printElement($i, $flag, $step) {
            if ($flag) {
                $action = $step["action"];
                $solution = $step["solution"];
                $hint = $step["hint"];
            } else {
                $action = "";
                $solution = "";
                $hint = "";
            }
            $baseInputText = "<div> <label class='lessonlables'> %%a: 
                                        <lable class='lessonLableDescription'>
                                            Please enter the step number
                                            <lable id='currentSteplable' class='currentSteplable' > 1 </lable>
                                                %%a info
                                        </label>
                                    </label>
<textarea class='lessonInfoElement' type='text'  name='%%b' id='%%b' placeholder='Step %%a'>%%c</textarea> </div>";
            $toReplace = array("%%a", "%%b", "%%c");
            $replaceWithAction = array("Action ", "action", $action);
            $replaceWithSolution = array("Solution ", "solution", $solution);
            $replaceWithHint = array("Hint ", "hint", $hint);
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
                    $.Storage.remove("active-step-num");
                    $.Storage.remove("lesson-total-number-of-steps");
                    $.Storage.remove("active-step");
                    var lessonStepValuesStorage = new Array(new Array());
                    $.Storage.set('lessonStepsValues',JSON.stringify(lessonStepValuesStorage, null, 2))
                    $.Storage.set("active-step" , "1");
                    $.Storage.set("lesson-total-number-of-steps" ,"0");
                </script>
                
                <?php
                foreach ($localSteps as $step) {
                    $i++;
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
                ?>  
                <div id="stepSection" style="margin-bottom:4px;" class="stepsSection">
                    <div>
                        
                            <lable class="lessonHeader"> Lesson Title : </lable> 
                            <input type="text" name="lessonTitle"  id="lessonTitle" class="lessonInput" placeholder="Lesson Title"
                                   value=" <?php echo $lessonFinalTitle ?>"
                                   />                      
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
                    // echo "<lable id='lessonStepLabel'> Lesson Step Title </lable>";
                    echo "<div id='stepNev'>";
                    echo "<lable class='lessonHeader'>lesson Steps" ;
                    if (isset($_GET['lesson']))    
                        echo " ↓(please choose step to edit)";
                    echo "</lable>";
                    
                    echo "<ul id='lessonStepUl'>";
                    echo "</ul>";
                    //Inserting the step div
                    echo "<div id ='stepbar'>";
                         echo " You are currently editing step" ;
                         ?>
                    <lable id='currentSteplable' class='currentSteplable'> 1 </lable> 
                    
                    <lable> (In order to edit  another step please select from the bar above ↑) </lable>

                        <?php
                    echo "</div>";
                    echo "<div class='actionButtons'>";
                        echo "<input type='button' id='addStep' class='lessonInputButton' value='Add lesson step' />"   ;               
                        echo "<input type='button' id='removeStep' class='lessonInputButton' value='Remove lesson step' />"  ;
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    ?>
                    <div class="leftLessonElem"> 
                        <lable class='lessonlables' > Title :  
                            <lable class='lessonLableDescription'>
                            <?php
                                $labelStepNumber = "<lable id='currentSteplable' class='currentSteplable' > 1 </lable> ";
                                echo "Please enter the step number ". $labelStepNumber .  " title description";
                                    
                            ?>
                            </lable>
                        </lable>

                        <textarea type="text"  name="title" id="title" placeholder="Step Title" class="lessonInfoElement" >
                        </textarea>
                        <?php
                            printElement($i, false, null);
                            if ($show)
                            {
                        ?>
                            <lable class='lessonlables' > Precedence :  </lable> 
                            <textarea type="text"  name="precedence" id="precedence" placeholder="precedence" class="lessonInfoElement" ><?php
                                echo $lessonPrecedence;
                            ?>
                            
                            </textarea> 
                        <?php
                            }
                         ?>

                    </div>
                    <div class="rightLessonElem"> 
                        <lable class='lessonlables' > Explanation 
                            <lable class='lessonLableDescription'>
                                <?php
                                    echo "Please enter the step info for step <lable id='currentSteplable' class='currentSteplable'> 1 </lable> ";
                                ?>
                            </lable>
                        </lable> 
                        
                        </br>
                        <textarea type="text"  name="explanation" id="explanation" class="expTxtErea1"></textarea>
                    </div>     

                     <div class="actionButtons">
                        <input type="button" id="btnSaveLesson" class="lessonInputButton" name="formSave" value="Save Lesson" />
                        <input type="button" id="btnDeleteLesson" class="lessonInputButton" name="formDelete" value="Delete Lesson" />
                    </div>
                </div> 
                <script type='text/javascript'>
                                                
                    //Print Nav  
                    window.createStepNavVar();
                        
                    window.showFirstStepIfExist();
                    
                </script>
                <?php
            } //end of if lesson exist
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
                    echo "<lable class='lessonHeader'>lesson Steps" ;
                    if (!isset($_GET['lesson']))    
                        echo " ↓(here you can add or remove steps)";
                    echo "</lable>";
                    echo "<ul id='lessonStepUl'>";
                    echo "</ul>";
                    echo "</div>";
                    //Inserting the step div
                    echo "<div id ='stepbar'>";
                         echo " You are currently editing step" ;
                   ?>
                    <lable id='currentSteplable' class='currentSteplable'> 1 </lable> 
                    
                    <lable> (In order to edit another step please select from the bar above ↑) </lable></br>
                    <lable> In order to create a new step please press on the "Add lesson step" button </lable>
                    <?php
                    echo "</div>";
                    
                    
                        echo "<div class='actionButtons'>";
                            echo "<input type='button' id='addStep' class='lessonInputButton' value='Add lesson step' />"   ;               
                            echo "<input type='button' id='removeStep' class='lessonInputButton' value='Remove lesson step' />"  ;
                        echo "</div>";
                    echo "</div>";
                    ?>
                    <div class="leftLessonElem"> 
                        
                        <lable class='lessonlables' > Title :  
                            <lable class='lessonLableDescription'>
                            <?php
                                $labelStepNumber = "<lable id='currentSteplable' class='currentSteplable' > 1 </lable> ";
                                echo "Please enter the step number ". $labelStepNumber .  " title description";
                                    
                            ?>
                            </lable>
                        </lable>
                        
                        
                        
                        <!-- <lable class='lessonlables' > Title :  </lable>  -->
                        <textarea type="text"  name="title" id="title" placeholder="Step Title" class="lessonInfoElement">
                        </textarea>
                        <?php
                        printElement($i, false, null);
                        ?>
                    </div>
                    <div class="rightLessonElem">
                        <lable class='lessonlables' > Explanation : </lable>
                        </br>
                        <textarea type="text"  name="explanation" id="explanation" class="expTxtErea1"></textarea>
                    </div>     
                    <div class="actionButtons">
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
