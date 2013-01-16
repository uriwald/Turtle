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
    $mongoid        =   new MongoId("4ecabd633b6d7b2407000000");
    $dbName         =   "turtleTestDb";
    $colFromName    =   "lessons_translate";
    $colToName      =   "lessons";
    $locale         =   "locale_ru_RU";
    $stepnum        =   1 ;
    collectionUtil::copyLocaleLessonBetweenCollections($mongoid, $dbName, $colFromName, $colToName,$locale , $stepnum);
    //collectionUtil::copyFullLessonBetweenCollections($mongoid, $dbName, $colFromName, $colToName);

?>
    