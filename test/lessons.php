<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
    session_start();
    $m = new Mongo();
    // select a database
    $db = $m->turtleTestDb;

    // select a collection (analogous to a relational database's table)
    $lessons = $db->lessons;
    $cursor = $lessons->findOne();
    var_dump($cursor);
?>

<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <script  type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">
            function bu()
            {

                tinyMCE.init({
                  
                    mode : "textareas",
                    theme : "advanced",
                   editor_selector : "mceAdvanced1" ,
                    plugins : "emotions,spellchecker,advhr,insertdatetime,preview", 
                
                    // Theme options - button# indicated the row# only
                    theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
                    theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
                    theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",      
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_resizing : true
                });
                
                     tinyMCE.init({
                    mode : "textareas",
                  theme : "simple",
                   editor_selector : "mceAdvanced2" ,
                    plugins : "emotions,spellchecker,advhr,insertdatetime,preview", 
                
                });
                
            }
            
            $(document).ready(function() {
                bu();
         //        tinyMCE.execCommand('mceAddControl', false, 'explanation1');
                $('#btnAdd').click(function() {       
                    var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
                    var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
                    $('#numOfObjects').attr('value',newNum);
                 tinyMCE.execCommand('mceFocus', false, 'explanation' + num);                    
                 tinyMCE.execCommand('mceRemoveControl', false, 'explanation' + num);

                    // create the new element via clone(), and manipulate it's ID using newNum value
                    var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
                    // manipulate the name/id values of the input inside the new element
                    newElem.children(':first').attr('id', 'title' + newNum).attr('name', 'title' + newNum);
                    newElem.children(':first').next().attr('id', 'explanation' + newNum).attr('name', 'explanation' + newNum).attr('class','mceAdvanced2');
                    newElem.children(':first').next().next().attr('id', 'action' + newNum).attr('name', 'action' + newNum);
                    newElem.children(':first').next().next().next().attr('id', 'solution' + newNum).attr('name', 'solution' + newNum);
                    newElem.children(':first').next().next().next().next().attr('id', 'hint' + newNum).attr('name', 'hint' + newNum);

 
                    // insert the new element after the last "duplicatable" input field
                    $('#input' + num).after(newElem);
 
                    // enable the "remove" button
                    $('#btnDel').attr('disabled','');
 
                         bu();
                      // tinyMCE.execCommand('mceAddControl', false, 'explanation' + newNum);
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

        <form id="myForm" action="processEditedRecord.php" method="post">
            Lesson Title : <input type="text" name="lessonTitle"  id="hint1" value="<?php echo $cursor["title"] ?>"/>
            <input type="text" name="ObjId" display="none" id="hint1" value="<?php echo $cursor["_id"] ?>"/>
             <?php
                $i = 0;
                
                $_SESSION['steps']  =   $cursor["steps"];
                echo count($cursor["steps"]);
                if (count($cursor["steps"]) >0 ) 
                {
                    foreach ( $cursor["steps"] as $step) 
                    {
                         $i++;

            ?>
            <div id="input<?php echo $i ?>" style="margin-bottom:4px;" class="clonedInput">
                
                Title:               <input type="text" name="title<?php echo $i ?>" id="<?php echo "title".$i ?>" value="<?php echo $step["title"] ?>"/>
                Explanation :        <textarea type="text" name="explanation<?php echo $i ?>" id="explanation<?php echo $i ?>" class="mceAdvanced1">
                                     </textarea> 


          
                Action:              <input type="text" name="action<?php echo $i ?>" id="action<?php echo $i ?>" />
                Solution:            <input type="text" name="solution<?php echo $i ?>" id="solution<?php echo $i ?>" />
                Hint:                <input type="text" name="hint<?php echo $i ?>"  id="hint<?php echo $i ?>" />

            </div>
            <?php
                    } //End of for each loop
                    ?>
                 <div>
                     <input type="button" id="btnAdd" value="add another name" />
                     <input type="button" id="btnDel" value="remove name" disabled="" />
                 </div>
              <?php   
                } //end of if
                else 
                {
             ?>
                        <div id="input1" style="margin-bottom:4px;" class="clonedInput">
                
                Title:                    <input type="text" name="title1" id="title1" />
                Explanation :  <textarea type="text" name="explanation1" id="explanation1" class="mceAdvanced1">
                                                  </textarea> 


          
                Action:                 <input type="text" name="action1" id="action1" />
                Solution:            <input type="text" name="solution1" id="solution1" />
                Hint:                       <input type="text" name="hint1"  id="hint1" />

            </div>

            <div>
                <input type="button" id="btnAdd" value="add another name" />
                <input type="button" id="btnDel" value="remove name" disabled="" />
            </div>
            <?php
                } //end of else
            ?>
            <input type="submit" id="btnSubmit" name="formSubmit" value="Submit" />

            <input type="text" name="numOfObjects" display="none" id="numOfObjects" value=<?php echo $i ?> />

        </form>
    </body>
</html>
