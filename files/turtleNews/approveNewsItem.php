<?php

/*
 * Approve or unapprove lessons
 */
        require_once("../utils/collectionUtil.php");
        require_once("../../environment.php");
        if (isset ($_GET["col"]))
            $dbLessonCollection =  $_GET["col"];
        echo " collection db is " . $dbLessonCollection;
        $lu = new collectionUtil($dbName , $dbLessonCollection);
        if (isset($_GET['item'])) {
            $item = new MongoId($_GET['item']);
            $bool = $_GET['pending'];
            $collection = $lu->CollectionItemChangeAttributeVal($item,"approve",$bool == 'true'? true: false);
            header("location: news.php");
        }
?> 