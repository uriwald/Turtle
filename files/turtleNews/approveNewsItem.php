<?php

/*
 * Approve or unapprove lessons
 */
        require_once("../utils/collectionUtil.php");
        require_once("../../environment.php");
        if (isset ($_GET["col"]))
            $db_lesson_collection =  $_GET["col"];
        echo " collection db is " . $db_lesson_collection;
        $lu = new collectionUtil($db_name , $db_lesson_collection);
        if (isset($_GET['item'])) {
            $item = new MongoId($_GET['item']);
            $bool = $_GET['pending'];
            $collection = $lu->collection_item_change_attribute_val($item,"approve",$bool == 'true'? true: false);
            header("location: news.php");
        }
?> 