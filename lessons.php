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
        <script type="text/javascript">
            function bu()
            {
                
                //$( 'textarea' ).ckeditor();
                //$( 'textarea' ).ckeditor( function() { /* callback code */ }, { skin : 'kama' , toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','Link', '-', 'MyButton' ] ] });
                var lang = document.getElementById('language');
                $( 'textarea' ).ckeditor( function() { /* callback code */ }, { language : lang.value , contentsLangDirection : 'ltr' ,skin : 'office2003' });       
            }

            $(document).ready(function() {
                bu();
                $('#btnAdd').click(function() {       
                    var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
                    var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
                    $('#numOfObjects').attr('value',newNum);

                    // create the new element via clone(), and manipulate it's ID using newNum value
                    var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
                    // manipulate the name/id values of the input inside the new element
                    newElem.children(':first').attr('id', 'title' + newNum).attr('name', 'title' + newNum).attr('value','');
                    newElem.children(':first').next().attr('id', 'explanation' + newNum).attr('name', 'explanation' + newNum).attr('value','');
                    // newElem.children(':first').next().next() is the cke element 
                    newElem.children(':first').next().next().remove();
                    newElem.children(':first').next().next().next().attr('id', 'action' + newNum).attr('name', 'action' + newNum).attr('value','');
                    newElem.children(':first').next().next().next().next().attr('id', 'solution' + newNum).attr('name', 'solution' + newNum).attr('value','');
                    newElem.children(':first').next().next().next().next().next().attr('id', 'hint' + newNum).attr('name', 'hint' + newNum).attr('value','');

 
                    // insert the new element after the last "duplicatable" input field
                    $('#input' + num).after(newElem);
 
                    // enable the "remove" button
                    $('#btnDel').attr('disabled','');
 
                    bu();
                    // business rule: you can only add 5 names
                    if (newNum == 10)
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
        <?php
        //session_start();
        require_once ("files/lessonsUtil.php");
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
            $lu = new lessonsUtil($locale, "locale_", $lessons, $_GET['lesson']);
            $theObjId = new MongoId($_GET['lesson']);
            $cursor = $lessons->findOne(array("_id" => $theObjId));
            $localSteps = $lu->getStepsByLocale($localePrefix . $_GET[$languageGet]);
            $lessonFinalTitle = $lu->getTitleByLocale($localePrefix . $_GET[$languageGet]);
        }
        ?>
        <form id="myForm" action="processEditedRecord.php" method="post">
            <div>
                <lable> Lesson Title : </lable> <input type="text" name="lessonTitle"  id="lessonTitle" value="<?php echo $lessonFinalTitle; ?>" />
            </div>                                
            Object ID: <input type="text" name="ObjId" display="none" id="lessonObjectId" value="<?php if (isset($cursor["_id"])) echo $cursor["_id"]; else {
            echo "";
        } ?>"/>
            
            <?php
            $i = 1; //Set default value to 1 in case there are no steps
            if (isset($cursor["steps"]) && count($cursor["steps"]) > 0) {
                $i = 0;
                foreach ($localSteps as $step) {
                    $i++;
            ?>
               <div id="input<?php echo $i ?>" style="margin-bottom:4px;" class="clonedInput">
                  <?php echo "Step Number " . $i . ",\n" ?>
                  <label>Title: </lable>               <input type="text" class="lessonElement" name="title<?php echo $i ?>" id="<?php echo "title" . $i ?>" value="<?php echo $step["title"] ?>"/>
                  </br>
                  <label>Explanation :  </lable>
                  <?php
                    $stepex = $step["explanation"];
                    echo "<textarea type='text' style='margin-left:40px;' name='explanation$i' id='explanation$i' >$stepex </textarea>"
                  ?>
                   <?php
                    $action = $step["action"];
                    $solution = $step["solution"];
                    $hint = $step["hint"];
                    // $baseInputText = "<div> <label> %%a: </label> <input type='text' style='width:500px;' class='lessonElement' name='%%b' id='%%b' value='%%c' />  </div>";
                    $baseInputText = "<div> <label class='lessonlables'> %%a: </label> <input type='text'  name='%%b' id='%%b' value='%%c' />  </div>";
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
                    Title:         <input type="text" name="title1" id="title1"  />
                    Explanation :  <textarea type="text"  name="explanation1" id="explanation1" />
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
                <input type="text" id="precedence" name="precedence" 
                       value =<?php 
                            if (isset($cursor["precedence"]))
                                echo $cursor["precedence"];
                            else
                                echo 1;
                       ?> />
                <input type="submit" id="btnSubmit" name="formSubmit" value="Save" />
                <input type="submit" id="btnDelete" name="formDelete" value="Delete Lesson" />
                <input type="text" name="language" id="language" display="none" value=<?php echo $locale ?> />
                <input type="text" name="numOfObjects" display="none" id="numOfObjects" value=<?php echo $i ?> />

                </form>
                </body>
                </html>
