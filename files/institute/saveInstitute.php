<?php

/*
 * Saving a user as an institute
 */
     require_once("../utils/collectionUtil.php");

    // Getting form Post info
    $email          = $_POST['email'];
    $permission     = $_POST['permission'];
    $name    = $_POST['name'];
    $description    = $_POST['desc'];
    
    //Check the institute email is in the users collection
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $strcol = $db->users;
    $strQuery               = array('email' => $email);
    $userExist            = $strcol->findOne($strQuery);
    $resultcount            = $strcol->count($strQuery);
    if ($resultcount > 0)
    {
       echo $userExist['_id'];
       $userId  =   $userExist['_id'];
       $mycollection = new collectionUtil("turtleTestDb","users");
       $mycollection->collection_item_add_attribute($userId,"institute","1,"); 
       $mycollection->collection_item_add_attribute($userId,"institute_description",$description);
       $mycollection->collection_item_add_attribute($userId,"institute_name",$name);
    }
    else {   
        echo " User does not exist";
    }
    
?>