<?php

/*
 * Approve or unapprove lessons
 */
        require_once("files/utils/collectionUtil.php");
        $lu = new collectionUtil("turtleTestDb" , "lessons");
                if (isset($_GET['lesson'])) {
            $lesson = new MongoId($_GET['lesson']);
            $bool = $_GET['pending'];
            $collection = $lu->CollectionItemChangeAttribute($lesson,"pending",$bool == 'true'? true: false);
            header("location: lessons.php");
        }
?>
