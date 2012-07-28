<?php
    require_once("files/collectionUtil.php");
    $lu = new collectionUtil("turtleTestDb" , "lessons");
    $singelItemId = new MongoId("4fec515e267cfe8c0d000000");
    $collection = $lu->CollectionItemChangeAttribute($singelItemId,"pending",false);
    //$collection = $lu->printCollectionItems();
    echo $collection;
?>
