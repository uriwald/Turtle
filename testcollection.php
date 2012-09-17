<?php
    require_once("files/utils/collectionUtil.php");
    $lu = new collectionUtil("turtleTestDb" , "lessons");
    $singelItemId = new MongoId("4fec515e267cfe8c0d000000");
    $collection = $lu->CollectionItemsAddAttribute("pending" , false);
    //$collection = $lu->CollectionItemChangeAttribute($singelItemId,"pending",false);
    ///$collection = $lu->printCollectionItems();
    echo $collection;
    
?>
