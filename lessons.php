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
        <script  type="text/javascript" src="alerts/jquery.alerts.js"></script>
        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->
        <link rel='stylesheet' href='./files/lessons.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./alerts/jquery.alerts.css' type='text/css' media='all'/>
        <script type="text/javascript">
            $.extend({
                getUrlVars: function(){
                    var vars = [], hash;
                    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                    for(var i = 0; i < hashes.length; i++)
                    {
                    hash = hashes[i].split('=');
                    vars.push(hash[0]);
                    vars[hash[0]] = hash[1];
                    }
                    return vars;
                },
                getUrlVar: function(name){
                    return $.getUrlVars()[name];
                }
            });
            
            function loadCKEditor()
            {
                //$( 'textarea' ).ckeditor( function() { /* callback code */ }, { skin : 'kama' , toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','Link', '-', 'MyButton' ] ] });
                var lang = document.getElementById('language');
                $( 'textarea.expTxtErea' ).ckeditor( function() { /* callback code */ }, { language : lang.value , contentsLangDirection : 'ltr' /*, skin : 'office2003' */});       
            }
            var showFirstStepIfExist = function showFirstStepIfExist()
            {
                if ($.Storage.get('lessonStepsValues'))
                {   
                    
                    if ($.Storage.get('active-step'))
                    {
                    var allsteps = JSON.parse($.Storage.get('lessonStepsValues'));
                    var currentSteps = allsteps[1];
                    $('#title').val(currentSteps[0]);
                    $('#action').val(currentSteps[1]);
                    $('#solution').val(currentSteps[2]);
                    $('#hint').val(currentSteps[3]);
                    $('#explanation').val(currentSteps[4]);  
                    }
            }
            };
            
            function getStepValues()
            {
                    var stepTitle = $('#title').val();
                    var stepAction = $('#action').val();
                    var stepSolution = $('#solution').val();
                    var stepHint = $('#hint').val();
                    var stepExplanation = $('#explanation').val();   
                    
                    var fullStep = new Array();
                    
                    fullStep[0] = stepTitle;
                    fullStep[1] = stepAction;
                    fullStep[2] = stepSolution;
                    fullStep[3] = stepHint;
                    fullStep[4] = stepExplanation;
                    
                    return fullStep;
            }
            
            function removestep(stepNumber)
            {
      
                jConfirm('Are you sure you want to delete step number ' + stepNumber , 'Confirmation Dialog', function(r) {
                    jAlert('Confirmed: ' + r, 'Confirmation Results');
                    if (r)
                        {
                            var allSteps = JSON.parse($.Storage.get("lessonStepsValues"));
                            allSteps.splice(stepNumber - 1,1);
                            $.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2));
                            var val = parseInt($.Storage.get("lesson-total-number-of-steps")) - 1;
                            $.Storage.set("lesson-total-number-of-steps" , val.toString());
                           createStepNavVar();    
                        }
                }); 
                
            }
            var addStepVar = function addStep(stepPosition , stepArray)
            {
                    var allSteps = JSON.parse($.Storage.get("lessonStepsValues"));
                    allSteps.splice (stepPosition , 0 , stepArray);
                    $.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2)) 
            };
            
            function onClick()
            {
                
            }
            function loadExistingLessonSteps()
            {
                var lessonid = $.getUrlVar('lesson');
                var locale = $.getUrlVar('l');
                    $.ajax({
                    url: 'files/loadLessonSteps.php?lesson=' + lessonid + '&l=' + locale,
                    success: function(data) {
                        $('.result').html(data);
                        //alert('Load was performed.');
                        var i = 1;
                        var step = new Array();
                        for (step in data)
                            {
                                 i = i + 1;
                            }
                    }
                });
                
            }
            
            var createStepNavVar = function createStepNav()
            {
               var lessonStepValuesStorage = new Array(new Array());
               if ($.Storage.get("lesson-total-number-of-steps"))
               {
                   //var currentNumOfLessonStep = $('.existing_step').length;
                   $('.existing_step').remove();
                   var numOfLessonSteps = $.Storage.get("lesson-total-number-of-steps");
                   var liElements = "";
                   for (i=1;i<=numOfLessonSteps;i++)
                   {
                       var id = 'lesson_step' + i ;
                       liElements += '<li class="existing_step" id='+ id + ">" + i + "</li>";
                   }
                   $("#lessonStepUl" ).append(liElements);
                      
               }
                else
                    {
                       $("#lessonStepUl" ).append('<li class="existing_step"> 1 </li>');  
                       $.Storage.set('lesson-total-number-of-steps' , '1');
                       $.Storage.set('lessonStepsValues',JSON.stringify(lessonStepValuesStorage, null, 2))
                    }
            };
            

            $(document).ready(function() {
                loadExistingLessonSteps();
                loadCKEditor();
                createStepNavVar();
                showFirstStepIfExist();
                $('#addStep').click(function () {
                    var val = parseInt($.Storage.get("lesson-total-number-of-steps")) + 1;
                    $.Storage.set("lesson-total-number-of-steps" , val.toString());
                    addStepVar(val , new Array());
                    createStepNavVar();
                });
               $('#removeStep').click(function () {
                    if (parseInt($.Storage.get("lesson-total-number-of-steps")) > 1)
                        {
                        if ($.Storage.get('active-step-num'))
                            {
                              removestep($.Storage.get('active-step-num'));
                            }
                        }

                });
                
                $('.existing_step').live("click" , function() {
                    var fullStep =  getStepValues();         
                    var allSteps;
                    if ($.Storage.get("lessonStepsValues"))
                    
                    {
                       allSteps = JSON.parse($.Storage.get("lessonStepsValues"));     
                    }
                    else
                    {
                       allSteps = new Array();     
                    }
                    
                    if ($.Storage.get("active-step"))
                    {
                       $.Storage.set($.Storage.get("active-step"), JSON.stringify(fullStep, null, 2));     
                       var name = '#' + $.Storage.get("active-step");
                       $(name).css('background-color' , 'white')
                    }
                    /*
                    else
                    {
                        $.Storage.set('lesson_step1',JSON.stringify(fullStep, null, 2));
                    }
                    */
                    
                    
                    if ($.Storage.get('active-step-num'))
                    {
                        //var arrayCell = parseInt($.Storage.get("active-step-num")) - 1;
                         allSteps.splice(parseInt($.Storage.get("active-step-num")),1,fullStep);              
                        //allSteps[arrayCell] =  fullStep;
                          $.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2))       
                    } else {
                       allSteps[0] =  fullStep;  
                       $.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2))   
                    }
                        
                    var pressed = $(this).attr('id');
                    $(this).css('background-color' , '#AAA');
                    $.Storage.set('active-step' , pressed);
                    $.Storage.set('active-step-num' , pressed.substring(11));
                    //if ($.Storage.get(pressed))
                    //    {
                            //var currentSteps = JSON.parse($.Storage.get(pressed));
                            var allsteps = JSON.parse($.Storage.get('lessonStepsValues'));
                            var currentSteps = allsteps[$.Storage.get('active-step-num')];
                            $('#title').val(currentSteps[0]);
                            $('#action').val(currentSteps[1]);
                            $('#solution').val(currentSteps[2]);
                            $('#hint').val(currentSteps[3]);
                            $('#explanation').val(currentSteps[4]);
                       // }
                
                   
                    //$.Storage.set("lesson-total-number-of-steps" , val.toString());
            
                });
                
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
            // $baseInputText = "<div> <label> %%a: </label> <input type='text' style='width:500px;' class='lessonElement' name='%%b' id='%%b' value='%%c' />  </div>";
            $baseInputText = "<div> <label class='lessonlables'> %%a: </label> <textarea type='text'  name='%%b' id='%%b' placeholder='Step %%a'>%%c</textarea> </div>";
            $toReplace = array("%%a", "%%b", "%%c");
            //$replaceWithAction = array("Action ", "action$i", $action);
            //$replaceWithSolution = array("Solution ", "solution$i", $solution);
            //$replaceWithHint = array("Hint ", "hint$i", $hint);
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
        <form id="myForm" action="processEditedRecord.php" method="post">
            <div>
                <lable> Lesson Title : </lable> <input type="text" name="lessonTitle"  id="lessonTitle" class="lessonInput" placeholder="Lesson Title"/>
            </div>                                
            Object ID: <input type="text" name="ObjId" display="none" id="lessonObjectId" class="lessonInput" value="<?php
        if (isset($cursor["_id"]))
            echo $cursor["_id"]; else {
            echo "";
        }
        ?>"/>

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
                         fullStep[4] = stepExplanation
                         ;
                         
                         //adding the step
                        window.addStepVar(stepNumber , fullStep);
                        //var allSteps = JSON.parse($.Storage.get("lessonStepsValues"));
                        //allSteps.splice (stepNumber , 0 , fullStep); 
                        //$.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2))             
                       
                    </script>
                    

                    
                    
                    

                 <?php
                 } //End of for each loop
                 
                  ?>  
                       <div id="input1" style="margin-bottom:4px;" class="clonedInput">
                        <?php
                            echo "<div id='lessonStep'>";
                                echo "<lable id='lessonStepLabel'> Lesson Step Title </lable>";
                                echo "<div id='stepNev'>" ;
                                echo    "<ul id='lessonStepUl'>";
                                echo    "</ul>";
                                echo "</div>";
                            echo "</div>";
                        ?>
                        <div class="leftLessonElem"> 
                             <lable class='lessonlables' > Title:  </lable> <textarea type="text"  name="title" id="title" ></textarea>
                                    <?php
                                         printElement($i, false, null);
                                    ?>
                        </div>
                        <div class="rightLessonElem">
                                <lable class='lessonlables' > Explanation : </lable> <textarea type="text"  name="explanation" id="explanation" class="expTxtErea"></textarea>
                        </div>     
                        
                        <div>
                            <input type="button" id="addStep" class="lessonInput" value="add Add lesson step" />
                            <input type="button" id="removeStep" class="lessonInput" value="remove lesson step" />
                        </div>
                    </div> 
                    
                    
                     <div>
                        <input type="button" id="btnAdd" class="lessonInput" value="Add lesson step" />
                        <input type="button" id="btnDel" class="lessonInput" value="remove lesoon step" />
                     </div>
                   
                    <script type='text/javascript'>
                                            
                    //Print Nav  
                    window.createStepNavVar();
                    
                    window.showFirstStepIfExist();
                
            </script>
            <?php
              } //end of if
            else {
                                ?>
                   <div id="input1" style="margin-bottom:4px;" class="clonedInput">
                        <?php
                            echo "<div id='lessonStep'>";
                                echo "<lable id='lessonStepLabel'> Lesson Step Title </lable>";
                                echo "<div id='stepNev'>" ;
                                echo    "<ul id='lessonStepUl'>";
                                echo    "</ul>";
                                echo "</div>";
                            echo "</div>";
                        ?>
                        <div class="leftLessonElem"> 
                             <lable class='lessonlables' > Title:  </lable> <textarea type="text"  name="title" id="title" ></textarea>
                                    <?php
                                         printElement($i, false, null);
                                    ?>
                        </div>
                        <div class="rightLessonElem">
                                <lable class='lessonlables' > Explanation : </lable> <textarea type="text"  name="explanation" id="explanation" class="expTxtErea"></textarea>
                        </div>     
                        
                        <div>
                            <input type="button" id="addStep" class="lessonInput" value="add Add lesson step" />
                            <input type="button" id="removeStep" class="lessonInput" value="remove lesson step" />
                        </div>
                    </div>     
    <?php
} //end of else
?>
                            <input type="text" id="precedence" class="lessonInput" name="precedence" 
                                   value =<?php
                            if (isset($cursor["precedence"]))
                                echo $cursor["precedence"];
                            else
                                echo 1;
?> />
                            <input type="submit" id="btnSubmit" class="lessonInput" name="formSubmit" value="Save" />
                            <input type="submit" id="btnDelete" class="lessonInput" name="formDelete" value="Delete Lesson" />
                            <input type="text" name="language" id="language" class="lessonInput" display="none" value=<?php echo $locale ?> />
                            <input type="text" name="numOfObjects" display="none" id="numOfObjects" class="lessonInput" value=<?php echo $i ?> />

                            </form>
                            </body>
                            </html>
