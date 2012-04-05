<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
         <script src="jquery.js"></script>
        <form action="php-form-processor.php" method="post">
            Please Insert the lessons title
            <input type="text" name="LessonTitle" maxlength="50" value="Lesson Title" />
            <br/>
            <br/>
         <?php
            for ( $counter = 1; $counter <= 10; $counter += 1) {
                echo "Please insert step number $counter";
            ?>
            <br/>
            Please insert Step title
            <input type="text" name="stepTitle<?php echo $counter;?>" maxlength="50"  id="stepTitle<?php echo $counter;?>"   />
            <br/>
            Please insert Step Explanation
            <input type="text" name="stepExplanation<?php echo $counter;?>" maxlength="50"  id="stepExplanation<?php echo $counter;?>"   />
            <br/>
            Please insert step action
            <input type="text" name="stepAction<?php echo $counter;?>" maxlength="50"id="stepAction<?php echo $counter;?>" />
            
             <br/>
            Please insert step Solution
            <input type="text" name="stepSolution<?php echo $counter;?>" maxlength="50"  id="stepSolution<?php echo $counter;?>"   />
            
           <br/>
            Please insert step Hint
            <input type="text" name="stepHint<?php echo $counter;?>" maxlength="50" id="stepHint<?php echo $counter;?>"   />
            <br/>
            <br/>
          
             <?php 
            }   
            ?>
            <input type="submit" name="formSubmit" value="Submit" />
        </form>
    </body>
</html>
