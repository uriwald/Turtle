<?php

/*
 * Approve or unapprove lessons
 */
        require_once("files/collectionUtil.php");
        $lu = new collectionUtil("turtleTestDb" , "lessons");
        
        $lessonFinalTitle = "";
        if (isset($_GET['lesson'])) {
            $lesson = new MongoId($_GET['lesson']);
            $bool = $_GET['pending'];
            $collection = $lu->CollectionItemChangeAttribute($lesson,"pending",$bool == 'true'? true: false);
            echo $collection; 
        }
?>
