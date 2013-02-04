<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();
(isset($_SESSION['Admin']) && $_SESSION['Admin'] == true) || (isset($_SESSION['Guest']) && $_SESSION['Guest'] == true) || (isset($_SESSION['translator']) && $_SESSION['translator'] == true) ? $show = true : $show = false;

$relPath = "files/bootstrap/twitter-bootstrap-sample-page-layouts-master/";
$ddPath = "files/test/dd/";
$jqueryui = "ajax/libs/jqueryui/1.10.0/";
if (!isset($locale)) {
    $locale = "en_US";
    $_SESSION['locale'] = "en_US";
}
?>

<html>
    <head>
        <?php
            $locale = "en_US";
            $languageGet = "l";
            if (isset($_GET[$languageGet]))
                $locale = $_GET[$languageGet];
            $formPullingSide ="";
            $formPullingSide = ($locale == "he_IL" ? "pull-right" : "pull-left");
            $login = ($locale != "he_IL" ? "pull-right" : "pull-left");
        ?>
        <title>
        </title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="<?php echo $ddPath . 'js/jquery/jquery-1.8.2.min.js' ?>"></script> 
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/dd.css' ?>" />
        <script src="<?php echo $ddPath . 'js/msdropdown/jquery.dd.min.js' ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/skin2.css' ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/flags.css' ?>" /> 
        <!-- Finish the dropdown dd directory related -->
        <?php
        if ($locale == "he_IL")
            echo "<link rel='stylesheet' type='text/css' href='files/css/lessons_rtl.css' /> ";   
        ?>
        <script  type="text/javascript" src="<?php echo $jqueryui . 'js/jquery-ui-1.10.0.custom.js' ?>"></script> <!--- equal to googleapis -->
        <link rel='stylesheet' href='<?php echo $jqueryui . 'css/ui-lightness/jquery-ui-1.10.0.custom.css' ?>' type='text/css' media='all'/> 
        <script  type="text/javascript" src="alerts/jquery.alerts.js"></script>
        <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="files/turtle.js"></script> <!-- Canvas turtle -->
        <script type="application/javascript" src="files/jquery.tmpl.js"></script> <!-- jquerytmpl -->
        <!--<script src="<?php echo $relPath . 'scripts/jquery.min.js' ?>"></script>-->
        <?php
        $file_path = "locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
        $username = "Unknown";
        if (isset($_SESSION['username']))
            $username = $_SESSION['username'];
        ?>        
        <script type="text/javascript">
            var locale = "<?php echo $locale; ?>";
        </script>
        <!--<link   rel="gettext" type="application/x-po" href="locale/he_IL/LC_MESSAGES/messages.po" /> <!-- Static Loading hebrew definition -->
        <script type="application/javascript" src="files/Gettext.js"></script> <!-- Using JS GetText -->
        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->

        <link href="files/bootstrap/css/bootstrap.css" rel="stylesheet"> 
        <link href="<?php echo $relPath . 'styles/bootstrap.min.css' ?>" rel="stylesheet"> 
        <!--<script type="application/javascript" src="<?php echo $relPath . 'scripts/bootstrap-dropdown.js' ?>"></script>  Bootstaps drop down -->
        <link   rel="stylesheet" href="./alerts/jquery.alerts.css" type="text/css" media="all" >  
        <script type="application/javascript" src="files/bootstrap/js/bootstrap.js"></script> <!-- Storage -->
        <script type="application/javascript" src="files/bootstrap/js/bootstrap.min.js"></script> <!-- Storage --> 

        <script type="application/javascript" src="files/js/lesson.js"></script> <!-- lessonFunctions --> 
    </head>
    <body>

        <!-- Should be different for log in user and for a guest -->
    <div class="topbar" style="position: static;">
            <div class="fill">
                <div class="container span13" style="float:none;" > 
                    <img class="brand" id="turtleimg" src="files/turtles.png" alt="צב במשקפיים">

                    <ul class="nav" id="turtleHeaderUl"> 
                            <li><a href="index.php" style="color:gray;" ><?php echo _("TurtleAcademy");?></a></li> 
                            <!--<li class="active"><a href="index.html"><?php echo _("Sample");?></a></li> -->
                    </ul>

                    <form class="<?php  
                                        echo $formPullingSide . " form-inline";                                
                                    ?>" action="" id="turtleHeaderLanguage">  
                        <select name="selectedLanguage" id="selectedLanguage" style="width:120px;">
                            <option value='en_US' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">English</option>
                            <option value='es_AR' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Español</option>
                            <option value='he_IL' data-image="Images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">עברית</option>
                            <option value='zh_CN' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">中文</option>
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
                                                <li><a tabindex="-1" href="/docs"   class="innerLink" id="help-nav"><?php echo _("My account");?></a></li>
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

                        }
                        ?>
                </div>
            </div> <!-- Ending fill barf -->
        </div> <!-- Ending top bar -->        
        
        
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
                    $lessons = $db->$dbLessonCollection;
                    $locale = "en_US";
                    $languageGet = "l";
                    $localePrefix = "locale_";
                    $lessonFinalTitle = "_";
                    $lessonPrecedence = 100;
                    if (isset($_GET[$languageGet]))
                        $locale = $_GET[$languageGet];
//If we are in existing lesson we will enter editing mode 
                    if (isset($_GET['lesson'])) {
                        $lu = new lessonsUtil($locale, "locale_", $lessons, $_GET['lesson']);
                        $theObjId = new MongoId($_GET['lesson']);
                        $cursor = $lessons->findOne(array("_id" => $theObjId));
                        $localSteps = $lu->getStepsByLocale($localePrefix . $locale);
                        $lessonFinalTitle = $lu->getTitleByLocale($localePrefix . $locale);
                        $lessonPrecedence = $lu->getPrecedence();
                        if (strlen($lessonFinalTitle) <= 1)
                            $lessonFinalTitle = "No Title";
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
            $baseInputText = "<div class='control-group lesson-label'> 
                                <label class='lesson-label' > %%a </label>
                                <div class='controlsa'>
                                     <textarea class='input-xlarge' type='text'  name='%%b' id='%%b' placeholder='Step %%a'>%%c</textarea> 
                                </div>                              
                             </div>";
            $toReplace = array("%%a", "%%b", "%%c");
            $replaceWithAction = array(_("Action"), "action", $action);
            $replaceWithSolution = array(_("Solution"), "solution", $solution);
            $replaceWithHint = array(_("Hint"), "hint", $hint);
            $elementAction = str_replace($toReplace, $replaceWithAction, $baseInputText);
            $elementSolution = str_replace($toReplace, $replaceWithSolution, $baseInputText);
            $elementHint = str_replace($toReplace, $replaceWithHint, $baseInputText);
            echo $elementAction;
            echo $elementSolution;
            echo $elementHint;
            echo "</fieldset></form>"; // Close the left lesson elements
        }

        function printLeftLessonElemnt($i, $show , $formPullingSide) {
            echo "<div class='leftLessonElem well span7 " . $formPullingSide . "' style='margin-top:10px; margin-left: 0px;  height:350px;'> 
                        <form class='form-stacked'>
                            <fieldset class='lesson-fieldset'> 
                                <div class='control-group lesson-label'> 
                                    <label class='lesson-label' >" . _("Title")  ."</label> 
                                    <div class='controlsa'>
                                        <textarea type='text'  name='title' id='title' placeholder='Step Title' class='input-xlarge' >
                                        </textarea>
                                    </div>                                 
                                </div>";

            printElement($i, false, null); 
            if ($show) {
                echo "<div class='control-group'> 
                                            <div class='controlsa'>
                                                <textarea type='text'  name='precedence' id='precedence' placeholder='precedence' class='input-xlarge'>";
                echo $lessonPrecedence;
                echo"</textarea>
                                            </div>
                                            <lable class='lesson-label' > Precedence : 
                                            </lable>   
                                        </div> ";
            } //End of if show
            echo "</fieldset>
                        </form>
                        <div>
                            <button class='btn' id='btnSaveLesson'>Save Lesson</button>
                            <button class='btn' id='btnShowLesson' title='show Lesson'>Show Lesson</button>
                            <button class='btn btn-danger' id='btnDeleteLesson'>Delete Lesson</button>
                        </div>
                    </div>"; // Closing left lesson elements
        }

//End of print left element

        function printRightLessonElemnt() {
            echo "<div class='rightLessonElem well span7' style='margin-top:10px; margin-left: 0px; height:350px;' > 
                            <form class='form-stacked'>
                                <fieldset>
                                    <div class='control-group lesson-label'>
                                            <label class='lesson-label' > " . _("Explanation") ." </label> 
                                        <div class='controlsa'>
                                            <textarea rows='15' type='text'  name='explanation' id='explanation' class='dscText input-xlarge'></textarea>
                                        </div>
                                    </div> 
                                </fieldset>
                            </form>
                             <div>
                                 <input type='button' id='btnShowDoc'      class='btn  btn-link' name='showDoc' value='Show reserve words' />
                            </div>
                        </div>";  //<!--  Close div RightLessonElem --> 
        }

        function printLessonSteps() {
            echo "<div id='lessonStep'>";
            echo "<div id='stepNev'>";
            echo "<h3 class='muted'>lesson Steps";
            if (isset($_GET['lesson']))
                echo " ↓(please choose step to edit)";
            echo "</h3>";
            echo "<div style='height:40px;'>";
            echo "<ul id='lessonStepUl' class=' nav nav-pills'>";
            echo "</ul>";
            echo "</div>";
            //Inserting the step div 
            echo "<div class='actionButtonsStep btn-group' >";
            echo "<button class='btn btn-danger' id='removeStep'>" . _("Remove lesson step") ."</button>";
            echo "</div>"; //End of actionButtons div
            echo "</div>"; //End of stepNev div
            echo "</div>"; //End of lessonStep div
        }

        function printLessonTitle($hasTitle, $lessonFinalTitle, $cursor) {
            echo "<div>
                            <h3 class='muted'>Lesson Title </h3>
                                <input type='text' name='lessonTitle'  id='lessonTitle' class='lessonInput' placeholder='Lesson Title'
                                   value=\"";
            if ($hasTitle)
                echo $lessonFinalTitle;
            else
                echo "";
            echo "\"/>";
            if ($hasTitle)
                echo "
                            <script type='text/javascript'>
                                $.Storage.set('lessonTitle' , '$lessonFinalTitle');
                            </script>";
            echo "
                            <input type='text' name='ObjId' style='display:none' id='lessonObjectId' class='lessonInput' value=\"";
            if (isset($cursor["_id"]))
                echo $cursor["_id"];
            else {
                echo "";
            }
            echo "\"/> 
                    </div>";
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
            $.Storage.remove("username");
            var lessonStepValuesStorage = new Array(new Array());
            $.Storage.set('lessonStepsValues',JSON.stringify(lessonStepValuesStorage, null, 2))
            $.Storage.set("active-step" , "lesson_step1");
            $.Storage.set("lesson-total-number-of-steps" ,"0");
            $.Storage.set("collection-name" ,"<?php echo $dbLessonCollection ?>");
            $.Storage.set("locale" ,"<?php echo $locale ?>");
            $.Storage.set("username" ,"<?php echo $username; ?>");
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
            <div class="container span16" style="float:none;" >
                <div id="stepSection" style="margin-bottom:4px;" class="stepsSection">    
                    <?php
                    printLessonTitle(true, $lessonFinalTitle, $cursor);
                    printLessonSteps();
                    printLeftLessonElemnt($i, $show ,$formPullingSide);
                    printRightLessonElemnt();
                    ?>
                </div> <!-- End of stepSection -->
            </div> <!-- container -->


            <!--
            <iframe id="frame"  height="700" width="90%" src="showLesson.php">
                <div id="previewLesson">
    <?php
    echo "hello rubio";
    ?>
                </div>
            </iframe>
            -->
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
            var lessonTitle = $('#lessonTitle').val();
            $.Storage.remove("collection-name");
            $.Storage.remove("lessonTitle");
            $.Storage.remove("active-step");
            $.Storage.remove("username");
            $.Storage.set("collection-name" ,"<?php echo $dbLessonCollection ?>");
            $.Storage.set("lessonTitle" ,lessonTitle);
            $.Storage.set("active-step" , "lesson_step1");
            $.Storage.set("username" ,"<?php echo $username ?>");
            </script>
            <div class="container span16" style="float:none;" >
                <div id="stepSection" style="margin-bottom:4px;" class="stepsSection ">                                
    <?php
    printLessonTitle(false, $lessonFinalTitle, false);
    printLessonSteps();
    printLeftLessonElemnt($i, $show, $formPullingSide);
    printRightLessonElemnt();
    ?>
                </div>  <!-- Finish div stepSection -->  
            </div> <!-- Finish stepContainer div -->
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
