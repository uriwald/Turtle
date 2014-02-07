<?php

/*
 * Approve or unapprove lessons
 */
        require_once("files/utils/collectionUtil.php");
        require_once("environment.php");
        if (isset ($_GET["col"]))
            $db_lesson_collection =  $_GET["col"];
        $lu = new collectionUtil($db_name , $db_lesson_collection);
        if (isset($_GET['lesson'])) {
            $lesson = new MongoId($_GET['lesson']);
            $bool = $_GET['pending'];
            $collection = $lu->collection_item_change_attribute_val($lesson,"pending",$bool == 'true'? true: false);
            header("location: lessons.php");
        }
?> 