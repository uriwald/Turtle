<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
    require_once("files/utils/collectionUtil.php");
    /*
    $lu = new collectionUtil("turtleTestDb" , "lessons");
    $singelItemId = new MongoId("5078fc8ca51ffbe80c000001");
    $collection = $lu->CollectionItemsAddAttribute("pending" , false);
    $collection = $lu->CollectionItemChangeAttribute($singelItemId,"user","admin");
    ///$collection = $lu->printCollectionItems();
    echo $collection;
    
    /*
     * Testing coping between collections
     */
    $mongoid        =   new MongoId($_POST['mongoid']);
    $dbName         =   "turtleTestDb";
    $colFromName    =   $_POST['copyfrom'];
    $colToName      =   $_POST['copyto'];
    
    //echo $_POST['mongoid'] ;
    //echo $colFromName ;
    //echo $colToName ;
    collectionUtil::copyFullLessonBetweenCollections($mongoid, $dbName, $colFromName, $colToName);

?>
