<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
    session_start();
    (isset($_SESSION['Admin']) && $_SESSION['Admin'] == true) || (isset($_SESSION['Guest']) && $_SESSION['Guest'] == true) || (isset($_SESSION['translator']) && $_SESSION['translator'] == true) ? $show = true : $show = false ;
?>

<html>
    <head>
        <title>
        </title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <!-- <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script  type="text/javascript" src="ajax/libs/jquery/jquery.min.js"></script> <!--- equal to googleapis -->
        <script  type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script  type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
        <script  type="text/javascript" src="alerts/jquery.alerts.js"></script>
        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->
        <script type="application/javascript" src="files/js/lesson.js"></script> <!-- lessonFunctions -->     
        
        <link rel='stylesheet' href='./files/css/lessons.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./files/bootstrap/css/bootstrap.css' type='text/css' media='all'/>
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
        require_once("environment.php");
        require_once("localization.php");
        require_once("files/cssUtils.php");
        require_once("files/utils/languageUtil.php");
        
        $m = new Mongo();
// select a database
        $db = $m->$dbName;
// select a collection (analogous to a relational database's table)
        if ($show == false)
            $dbLessonCollection = "lessons_created_by_guest";
        //echo $dbLessonCollection;
        $lessons            = $db->$dbLessonCollection;
        $locale             = "en_US";
        $languageGet        = "l";
        $localePrefix       = "locale_";
        $lessonFinalTitle   = "";
        $lessonPrecedence   = 100;
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
            //echo $lessonPrecedence;
            //echo $lessonFinalTitle;
        }
        ?>

        <?php
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
            // <label class='control-label' > %%a: </lable>
            $baseInputText = "<div class='control-group'> 
                                <div class='controlsa'>
                                     <textarea class='input-xlarge' type='text'  name='%%b' id='%%b' placeholder='Step %%a'>%%c</textarea> 
                                </div> 
                                <label class='control-label lesson-label' > %%a </label>
                             </div>";
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
                    $.Storage.remove("collection-name");
                    var lessonStepValuesStorage = new Array(new Array());
                    $.Storage.set('lessonStepsValues',JSON.stringify(lessonStepValuesStorage, null, 2))
                    $.Storage.set("active-step" , "1");
                    $.Storage.set("lesson-total-number-of-steps" ,"0");
                    $.Storage.set("collection-name" ,"<?php echo $dbLessonCollection ?>");
                    $.Storage.set("locale" ,"<?php echo $locale ?>");
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
                        
                            <lable class="lessonHeader"> Lesson Title  </lable> 
                            <input type="text" name="lessonTitle"  id="lessonTitle" class="lessonInput" placeholder="Lesson Title"
                                   value="<?php echo $lessonFinalTitle ?>"
                            />    
                            </input>
                            <script type='text/javascript'>
                                $.Storage.set("lessonTitle" ,"<?php echo $lessonFinalTitle ?>");
                            </script>
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
                            echo "<div id='stepNev'>";
                                echo "<lable class='lessonHeader'>lesson Steps" ;
                                if (isset($_GET['lesson']))    
                                    echo " ↓(please choose step to edit)";
                                echo "</lable>";
                                echo "<ul id='lessonStepUl'>";
                                echo "</ul>";
                        //Inserting the step div
                                echo "<div class='actionButtonsStep'>";
                                    echo "<input type='button' id='addStep' class='lessonInputButton' value='Add lesson step' />"   ;               
                                    echo "<input type='button' id='removeStep' class='lessonInputButton' value='Remove lesson step' />"  ;
                                echo "</div>"; //End of actionButtons div
                                echo "<div id ='stepbar'>";
                                    echo " <lable class='currentSteplableText'>Step </lable>" ;
                                    ?>
                                    <lable id='currentSteplable' class='currentSteplable'> 1 </lable> 
                                    <!-- <lable> (In order to edit  another step please select from the bar above ↑) </lable> -->
                                    <?php
                                echo "</div>"; //End of stepbar div
                           echo "</div>"; //End of stepNev div
                       echo "</div>"; //End of lessonStep div
                    ?>
                    <!--
                    <div class="actionButtons">
                        <input type="button" id="btnSaveLesson"   class="btn lessonInputButton"          name="formSave" value="Save Lesson" />
                        <input type="button" id="btnShowLesson"   class="btn lessonInputButton"          name="formSave" value="show Lesson" />
                        <input type="button" id="btnDeleteLesson" class="btn lessonInputButton"          name="formDelete" value="Delete Lesson" />
                        <input type="button" id="btnShowDoc"      class="btn  btn-link" name="showDoc" value="Show reserve words" />
                    </div>
                    -->
                    <div class="leftLessonElem"> 
                        <form class="form-horizontal">
                            <fieldset>
                                <div class="control-group">
  
                                    <div class="controlsa">
                                        <textarea type="text"  name="title" id="title" placeholder="Step Title" class="input-xlarge" >
                                        </textarea>
                                    </div>
                                    <lable class="control-label lesson-label" > Title   
                                    </lable>  
                                </div>
                                <?php
                                    printElement($i, false, null);
                                    if ($show)
                                    {
                                    ?>
                                        <div class="control-group"> 
                                            <div class="controlsa">
                                                <textarea type="text"  name="precedence" id="precedence" placeholder="precedence" class="input-xlarge"><?php                            
                                                    echo $lessonPrecedence;
                                                ?>
                                                </textarea>
                                            </div>
                                            <lable class="control-label lesson-label" > Precedence : 
                                            </lable>   
                                        </div>
                                    <?php
                                    } //End of if show
                                    ?>

                            </fieldset>
                        </form>

                    </div> <!--  Close div leftLessonElem style="visibility:hidden;" -->
                    <div class="rightLessonElem" > 
                        <div class="control-group">
                                <lable class="control-label lesson-label" > Explanation   
                                </lable> 
                            <div class="controlsa">
                                <textarea rows="15" type="text"  name="explanation" id="explanation" class="dscText input-xxlarge "></textarea>
                            </div>
                        </div>
                        <!--
                        <iframe id="frame"  height="700" width="700" src="showLesson.php">
                            <div id="previewLesson">
                                <?php
                                    echo "hello rubio";
                                ?>
                            </div>
                        </iframe>   
                        -->
                    </div>  <!--  Close div RightLessonElem -->
                    <!--
                    <div class="rightLessonElem" > 
                        <input type="button" id="btnSaveLesson"   class="btn lessonInputButton"          name="formSave" value="Save Lesson" /> </br></br>
                        <input type="button" id="btnShowLesson"   class="btn lessonInputButton"          name="formSave" value="show Lesson" /> </br></br>
                        <input type="button" id="btnDeleteLesson" class="btn lessonInputButton"          name="formDelete" value="Delete Lesson" /> </br></br>
                        <input type="button" id="btnShowDoc"      class="btn  btn-link" name="showDoc" value="Show reserve words" /> </br></br>
                    </div>  <!--  Close div RrightLessonElem -->
                </div> 
                <div class="actionButtonsLessons">
                    <input type="button" id="btnSaveLesson"   class="btn lessonInputButton"          name="formSave" value="Save Lesson" />
                    <input type="button" id="btnShowLesson"   class="btn lessonInputButton"          name="formSave" value="show Lesson" />
                    <input type="button" id="btnDeleteLesson" class="btn lessonInputButton"          name="formDelete" value="Delete Lesson" />
                    <input type="button" id="btnShowDoc"      class="btn  btn-link" name="showDoc" value="Show reserve words" />
                </div>
                <iframe id="frame"  height="700" width="90%" src="showLesson.php">
                    <div id="previewLesson">
                        <?php
                            echo "hello rubio";
                        ?>
                    </div>
                </iframe> 
                <script type='text/javascript'>
                                                
                    //Print Nav  
                    window.createStepNavVar();
                        
                    window.showFirstStepIfExist();
                    
                </script>
            <?php
                } //end of if lesson exist
                else { //Starting case of creating a new lesson
            ?>
                <script type='text/javascript'>
                     var lessonTitle = $.('#lessonTitle').val();
                     $.Storage.remove("collection-name");
                     $.Storage.remove("lessonTitle");
                     $.Storage.set("collection-name" ,"<?php echo $dbLessonCollection ?>");
                     $.Storage.set("lessonTitle" ,lessonTitle);
                </script>
                <div id="stepSection" style="margin-bottom:4px;" class="stepsSection">
                    <div>                           
                            <lable class="lessonHeader"> Lesson Title  </lable>

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
                            echo " <lable class='currentSteplable'>Step </lable>" ;
                   ?>
                                <lable id='currentSteplableText' class='currentSteplable'> 1 </lable>          
                                <lable> (In order to edit another step please select from the bar above ↑) </lable></br>
                                <lable> In order to create a new step please press on the "Add lesson step" button </lable>
                    <?php
                            echo "</div>";                        
                            echo "<div class='actionButtonsStep'>";
                                echo "<input type='button' id='addStep' class='lessonInputButton' value='Add lesson step' />"   ;               
                                echo "<input type='button' id='removeStep' class='lessonInputButton' value='Remove lesson step' />"  ;
                            echo "</div>";
                         echo "</div>"; //Closing the lessonStep div
                    ?>
                    <div class="actionButtonsLessons">
                        <input type="button" id="btnSaveLesson"   class="btn lessonInputButton"          name="formSave" value="Save Lesson" />
                        <input type="button" id="btnShowLesson"   class="btn lessonInputButton"          name="formSave" value="show Lesson" />
                        <input type="button" id="btnDeleteLesson" class="btn lessonInputButton"          name="formDelete" value="Delete Lesson" />
                        <input type="button" id="btnShowDoc"      class="btn  btn-link" name="showDoc" value="Show reserve words" />
                    </div>
                     <div class="leftLessonElem"> 
                        <form class="form-horizontal">
                            <fieldset>
                                <div class="control-group">
                                        <lable class="control-label lesson-label" > Title   
                                        <?php
                                        // $labelStepNumber = "<lable id='currentSteplable' class='currentSteplable' > 1 </lable> ";
                                        // echo "Please enter the step number ". $labelStepNumber .  " title description";
                                        ?>
                                        </lable>    
                                    <div class="controlsa">
                                        <textarea type="text"  name="title" id="title" placeholder="Step Title" class="input-xlarge" >
                                        </textarea>
                                    </div>
                                </div>
                                <?php
                                    printElement($i, false, null);
                                    if ($show)
                                    {
                                    ?>
                                        <div class="control-group">
                                            <lable class="control-label lesson-label" > Precedence  
                                            </lable>    
                                            <div class="controlsa">
                                                <textarea type="text"  name="precedence" id="precedence" placeholder="precedence" class="input-xlarge"><?php                            
                                                    echo $lessonPrecedence;
                                                ?>
                                                </textarea>
                                            </div>
                                        </div>
                                    <?php
                                    } //End of if show
                                    ?>

                            </fieldset>
                        </form>
                    </div> <!--  Close div leftLessonElem  div class="rightLessonElem" style="visibility:hidden;">  -->
                    <div class="rightLessonElem"> 
                        <div class="control-group">
                                <lable class="control-label lesson-label" > Explanation   
                                </lable> 
                            <div class="controlsa">
                                <textarea rows="15" type="text"  name="explanation" id="explanation" class="dscText input-xxlarge"></textarea>
                            </div>
                        </div>
                    <div class="actionButtonsLessons">
                        <input type="button" id="btnSaveLesson"   class="btn lessonInputButton"          name="formSave" value="Save Lesson" />
                        <input type="button" id="btnShowLesson"   class="btn lessonInputButton"          name="formSave" value="show Lesson" />
                        <input type="button" id="btnDeleteLesson" class="btn lessonInputButton"          name="formDelete" value="Delete Lesson" />
                        <input type="button" id="btnShowDoc"      class="btn  btn-link" name="showDoc" value="Show reserve words" />
                    </div>
                        <!--
                        <iframe id="frame"  height="700" width="700" src="showLesson.php">
                            <div id="previewLesson">
                                <?php
                                    echo "hello rubio";
                                ?>
                            </div>
                        </iframe>   
                        -->
                    </div>  <!--  Close div RightLessonElem -->
                </div>     
                <?php
            } //end of else (New Lesson) 
            ?>
        <div id="message" style="display: none;">
            <div id="waiting" style="display: none;">
                Please wait<br />
            </div>
        </div>           
                  
    </body>
</html>
