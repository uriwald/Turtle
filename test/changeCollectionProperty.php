<?php
    require_once '../files/utils/collectionUtil.php';
   
    $db  =   "turtleTestDb";
    $collection = "programs";
    $mongonum = "52dbf64ea51ffbd836000000";
    $attName = "displayInProgramPage";
    $attVal = true;
    $mongoid = new MongoId($mongonum);
    //collectionUtil ::  CollectionItemChangeAttVal ($db,$collection ,$mongoid , $attName , $attVal) ;
    collectionUtil :: change_all_collection_objects_property("programs" , "displayInProgramPage" , true) ;
?>