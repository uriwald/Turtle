<?php
    require_once("files/utils/collectionUtil.php");
    
    //$lu = new collectionUtil("turtleTestDb" , "lessons_translate");
    $lu = new collectionUtil("turtleTestDb" , "lessons");
    $lu->CollectionItemsAddAttribute("register_only", false);
    //$singelItemId = new MongoId("510b6df9f458590a73000000");
    //$collection = $lu->cloneColumn($singelItemId,"data","stepCompleted"); 
    //$lu->cloneColumnrs("data","stepCompleted"); 
    //$collection = $lu->CollectionItemChangeAttribute($singelItemId,"lesson_turtle_id","16");
    ///$collection = $lu->printCollectionItems();
    //echo $collection;
    
    /*
     * Testing coping between collections
     */
    
    /*
    $mongoid        =   new MongoId("4ecabd633b6d7b2407000000");
    $dbName         =   "turtleTestDb";
    $colFromName    =   "lessons_translate";
    $colToName      =   "lessons";
    $locale         =   "locale_ru_RU";
    $stepnum        =   1 ;
    collectionUtil::copyLocaleLessonBetweenCollections($mongoid, $dbName, $colFromName, $colToName,$locale , $stepnum);
    //collectionUtil::copyFullLessonBetweenCollections($mongoid, $dbName, $colFromName, $colToName);
*/
?>
    