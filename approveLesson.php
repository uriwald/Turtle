<?php

/*
 * Approve or unapprove lessons
 */
        require_once("files/utils/collectionUtil.php");
        require_once("environment.php");
        if (isset ($_GET["col"]))
            $dbLessonCollection =  $_GET["col"];
        $lu = new collectionUtil($dbName , $dbLessonCollection);
                if (isset($_GET['lesson'])) {
            $lesson = new MongoId($_GET['lesson']);
            $bool = $_GET['pending'];
            $collection = $lu->CollectionItemChangeAttribute($lesson,"pending",$bool == 'true'? true: false);
            header("location: lessons.php");
        }
?> 