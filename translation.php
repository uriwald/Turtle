<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>


<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <script  type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script  type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
        <link rel='stylesheet' href='./files/lessons.css' type='text/css' media='all'/>
        <?php
        session_start();
        require_once ("files/lessonsUtil.php");
        $m = new Mongo();
// select a database
        $db = $m->turtleTestDb;
// select a collection (analogous to a relational database's table)
        $lessons = $db->lessons;


        $theObjId = new MongoId($_GET['lesson']);
//echo "The get param is ". $_GET['lesson']. "end of get param";
        $cursor = $lessons->findOne(array("_id" => $theObjId));
        $fromLanguage = $cursor["steps"];
//print_r($fromLanguage);
        $toLanguage = $cursor["steps"];
        $lessonSteps = $cursor["steps"];

        $languageFromGet = "lfrom";
        $languageToGet = "lto";
        $localePrefix = "locale_";

        $lu = new lessonsUtil($_GET[$languageFromGet], "locale_", $lessons, $_GET['lesson']);
        /*
          foreach ($lessonSteps as $key => $value) {

          if (isset($lessonSteps[$key][$localePrefix . $_GET[$languageFromGet]])) {
          $fromLanguage[$key] = $lessonSteps[$key][$localePrefix . $_GET[$languageFromGet]];
          }
          if (isset($lessonSteps[$key][$localePrefix . $_GET[$languageToGet]])) {
          $toLanguage[$key] = $toLanguage[$key][$localePrefix . $_GET[$languageToGet]];
          }
          }
        */
        $fromLanguage = $lu->getStepsByLocale($localePrefix . $_GET[$languageFromGet]);
        $toLanguage = $lu->getStepsByLocale($localePrefix . $_GET[$languageToGet]);

        $cursortitle = $cursor["title"];
        foreach ($cursortitle as $key => $value) {

            if (isset($_GET[$languageFromGet])) {
                if ($key == $localePrefix . $_GET[$languageFromGet]) {

                    $cursor["title"] = $cursortitle[$key];
                }
            } else { //Case no Language set
                $cursor["title"] = $cursortitle[$key];
            }
        }
        ?>
        <script type="text/javascript">
            function bu()
            {
                $( 'textarea' ).ckeditor();
               
            }
            
            $(document).ready(function() {
                bu();
                $('#btnAdd').click(function() {       
                    var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
                    var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
                    $('#numOfObjects').attr('value',newNum);
                    CKEDITOR.replace( 'explanation' + num );
                    // create the new element via clone(), and manipulate it's ID using newNum value
                    var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
                    // manipulate the name/id values of the input inside the new element
                    newElem.children(':first').attr('id', 'title' + newNum).attr('name', 'title' + newNum).attr('value','');
                    newElem.children(':first').next().attr('id', 'explanation' + newNum).attr('name', 'explanation' + newNum).attr('value','');
                    newElem.children(':first').next().next().attr('id', 'action' + newNum).attr('name', 'action' + newNum).attr('value','');
                    newElem.children(':first').next().next().next().attr('id', 'solution' + newNum).attr('name', 'solution' + newNum).attr('value','');
                    newElem.children(':first').next().next().next().next().attr('id', 'hint' + newNum).attr('name', 'hint' + newNum).attr('value','');

 
                    // insert the new element after the last "duplicatable" input field
                    $('#input' + num).after(newElem);
 
                    // enable the "remove" button
                    $('#btnDel').attr('disabled','');
 
                    bu();
                    // business rule: you can only add 5 names
                    if (newNum == 5)
                        $('#btnAdd').attr('disabled','disabled');
                });
                
                $('#btnSubmit').click(function() {
                    var num     = $('.clonedInput').length;
                    $('#btnSubmit').attr('value',num);
                 
                });

                $('#btnDel').click(function() {
                    var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
                    $('#input' + num).remove();     // remove the last element
                    $('#numOfObjects').attr('value',num - 1);
                    // enable the "add" button
                    $('#btnAdd').attr('disabled','');
             
                    // if only one element remains, disable the "remove" button
                    if (num-1 == 1)
                        $('#btnDel').attr('disabled','disabled');
                });
 
                $('#btnDel').attr('disabled','disabled');
            });
        </script>
    </head>
    <body>
        <table>
            <tr>
                <td style="width: 550px">
                    <span id="left">
                        <form id="myForm" action="processTranslation.php" method="post">
                            Lesson Title : <input type="text" name="lessonTitle"  id="lessonTitle" value="<?php
        if (isset($cursor["title"]))
            echo $cursor["title"];
        else {
            echo "";
        }
        ?>"/>
                            Object ID: <input type="text" name="ObjId" display="none" id="lessonObjectId" value="<?php echo $cursor["_id"] ?>"/>
                            <?php
                            $i = 0;

                            echo count($cursor["steps"]);
                            if (count($cursor["steps"]) > 0) {
                                foreach ($fromLanguage as $step) {
                                    $i++;
                                    ?>
                                    <div id="input<?php echo $i ?>" style="margin-bottom:4px;" class="clonedInput">

                                        <?php echo "Step Number " . $i . "\n" ?>
                                        Title:               <input type="text" class="lessonElement" name="title<?php echo $i ?>" id="<?php echo "title" . $i ?>" value="<?php echo $step["title"] ?>" disabled="disabled"/>
                                        Explanation :        
                                        <?php
                                        $stepex = $step["explanation"];
                                        echo "<textarea type='text' name='explanation1$i' id='explanation1$i' >$stepex </textarea>"
                                        ?>




                                        <?php
                                        //$stepex = $step["explanation"];
                                        //echo "<textarea type='text' name='explanation1$i' id='explanation1$i' >$stepex </textarea>"  
                                        ?>

                                        <?php
                                        $action = $step["action"];
                                        $solution = $step["solution"];
                                        $hint = $step["hint"];
                                        $baseInputText = "%%a: <input type='text' style='width:500px;' class='lessonElement' name='%%b' id='%%b' value='%%c' disabled='disabled' /> ";
                                        $toReplace = array("%%a", "%%b", "%%c");

                                        $replaceWithAction = array("Action ", "action$i", $action);
                                        $replaceWithSolution = array("Solution ", "solution$i", $solution);
                                        $replaceWithHint = array("Hint ", "hint$i", $hint);

                                        $elementAction = str_replace($toReplace, $replaceWithAction, $baseInputText);
                                        $elementSolution = str_replace($toReplace, $replaceWithSolution, $baseInputText);
                                        $elementHint = str_replace($toReplace, $replaceWithHint, $baseInputText);
                                        echo $elementAction;
                                        echo $elementSolution;
                                        echo $elementHint;
                                        ?>

                                    </div>
                                    <?php
                                } //End of for each loop
                                ?>
                                <div>
                                    <input type="button" id="btnAdd" value="Add lesson step" disabled='disabled' />
                                    <input type="button" id="btnDel" value="remove lesoon step" disabled='disabled' />
                                </div>
                                <?php
                            } //end of if
                            else {
                                ?>
                                <div id="input1" style="margin-bottom:4px;" class="clonedInput">

                                    Title:                    <input type="text" name="title1" id="title1" />
                                    Explanation :  <textarea type="text"  name="explanation11">
                                    </textarea> 



                                    Action:                 <input type="text" name="action1" id="action1" />
                                    Solution:            <input type="text" name="solution1" id="solution1" />
                                    Hint:                       <input type="text" name="hint1"  id="hint1" />

                                </div>

                                <div>
                                    <input type="button" id="btnAdd" value="add Add lesson step" disabled='disabled'/>
                                    <input type="button" id="btnDel" value="remove lesson step" disabled='disabled' />
                                </div>
                                <?php
                            } //end of else
                            ?>
                            <input type="submit" id="btnSubmit" name="formSubmit" value="Save" disabled='disabled' />

                            <input type="text" name="numOfObjects" display="none" id="numOfObjects" value=<?php echo $i ?> />

                        </form>
                </td>
                <td style="width: 550px">
                    <form id="myForm" action="processTranslation.php" method="post">
                        Lesson Title : <input type="text" name="lessonTitle"  id="lessonTitle" value="<?php echo $cursor["title"] ?>"/>
                        Object ID: <input type="text" name="ObjId" display="none" id="lessonObjectId" value="<?php echo $cursor["_id"] ?>"/>
                        <?php
                        $i = 0;

                        $_SESSION['steps'] = $cursor["steps"];
                        echo count($cursor["steps"]);
                        if (count($cursor["steps"]) > 0) {
                            foreach ($toLanguage as $step) {
                                $i++;
                                ?>
                                <div id="input<?php echo $i ?>" style="margin-bottom:4px;" class="clonedInput">

                                    <?php echo "Step Number " . $i . "\n" ?>
                                    Title:               <input type="text" class="lessonElement" name="<?php echo "title" . $i ?>" id="<?php echo "title" . $i ?>" value="<?php echo $step["title"] ?>"/>
                                    Explanation :        
                                    <?php
                                    $stepex = $step["explanation"];
                                    echo "<textarea type='text' name='explanation$i' id='explanation$i' >$stepex </textarea>"
                                    ?>



                                    <?php
                                    $action = $step["action"];
                                    $solution = $step["solution"];
                                    $hint = $step["hint"];
                                    $baseInputText = "%%a: <input type='text' style='width:500px;' class='lessonElement' name='%%b' id='%%b' value='%%c' /> ";
                                    $toReplace = array("%%a", "%%b", "%%c");

                                    $replaceWithAction = array("Action ", "action$i", $action);
                                    $replaceWithSolution = array("Solution ", "solution$i", $solution);
                                    $replaceWithHint = array("Hint ", "hint$i", $hint);

                                    $elementAction = str_replace($toReplace, $replaceWithAction, $baseInputText);
                                    $elementSolution = str_replace($toReplace, $replaceWithSolution, $baseInputText);
                                    $elementHint = str_replace($toReplace, $replaceWithHint, $baseInputText);
                                    echo $elementAction;
                                    //   echo "Action: <input type='text' class='lessonElement' name='action$i' id='action$i' value='$action' />";
                                    echo $elementSolution;
                                    echo $elementHint;
                                    ?>

                                </div>
                                <?php
                            } //End of for each loop
                            ?>
                            <div>
                                <input type="button" id="btnAdd" value="Add lesson step" />
                                <input type="button" id="btnDel" value="remove lesoon step" disabled="" />
                            </div>
                            <?php
                        } //end of if
                        else {
                            ?>
                            <div id="input1" style="margin-bottom:4px;" class="clonedInput">

                                Title:                    <input type="text" name="title1" id="title1" />
                                Explanation :  <textarea type="text"  name="explanation1" id="explanation1">
                                </textarea> 



                                Action:                 <input type="text" name="action1" id="action1" />
                                Solution:            <input type="text" name="solution1" id="solution1" />
                                Hint:                       <input type="text" name="hint1"  id="hint1" />

                            </div>

                            <div>
                                <input type="button" id="btnAdd" value="add Add lesson step" />
                                <input type="button" id="btnDel" value="remove lesson step" disabled="" />
                            </div>
                            <?php
                        } //end of else
                        ?>
                        <select name="language">
                            <option value="en_US">English</option>
                            <option value="he_IL">Hebrew</option>
                            <option value="sp_SP">Spanish</option>
                        </select>
                        <input type="submit" id="btnSubmit" name="formSubmit" value="Save" />
                        <input type="text" name="numOfObjects" display="none" id="numOfObjects" value=<?php echo $i ?> />
                    </form>  
                </td> <!-- End of right span -->
            </tr>
        </table>
        <!-- End of main div -->

    </body>
</html>
