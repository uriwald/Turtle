<?php
    require_once '../files/utils/collectionUtil.php';
   
    $db  =   "turtleTestDb";
    $collection = "programs";
    $mongonum = "52f157adf45859f96e000000";
    $attName = "username"; 
    $attVal = "nirkatz";
    $mongoid = new MongoId($mongonum);
    collectionUtil ::  collection_item_change_attrivute_val ($db,$collection ,$mongoid , $attName , $attVal) ;
    //collectionUtil :: change_all_collection_objects_property("programs" , "displayInProgramPage" , true) ;
?>