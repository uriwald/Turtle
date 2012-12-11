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
    var_dump($_POST);
    
    $mongoid        =   new MongoId($_POST['mongoid']);
    $dbName         =   "turtleTestDb";
    $colFromName    =   $_POST['copyfrom'];
    $colToName      =   $_POST['copyto'];
    $locale         =   $_POST['selectedLanguage'];
    $stepnum        =  $_POST['stepno'];
    //echo $_POST['mongoid'] ;
    //echo $colFromName ;
    //echo $colToName ;
    
    collectionUtil::copyLocaleLessonBetweenCollections($mongoid ,$dbName,$colFromName , $colToName , $locale , $stepnum);
?>
