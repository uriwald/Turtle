<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    //require_once("../environment.php");
    
    //Getting User Info
    $user = "Unknown";
    $username   = "username";
    if (isset($_SESSION[$username]))
    {
        $user = $_SESSION[$username] ;
    }
    else
    {
        echo "";
        exit();
    }
    $return['username'] = $user;
    $storageData    = "";  
    if (isset($_POST['lclStoragevalues']))
    {
        $storageData            =   $_POST['lclStoragevalues'];   
        $return['lclsValues']   =   $storageData ;
    }   
    $m                  =   new Mongo();
    $db                 =   $m->turtleTestDb;
    $userProgress       =   "user_progress";
    $userProgressCol    =   $db->$userProgress;   
    //Checking if the user already has some data
    $userQuery       = array('username' => $user);
    $userDataExist       = $userProgressCol->findOne($userQuery);
    $resultcount     = $userProgressCol->count($userQuery);
    
    //Case we need to add a new record to db
    if (!$resultcount > 0 ) 
    {
        $structure = array("username" => $user, "data" => $storageData);
        $result = $userProgressCol->insert($structure, array('safe' => true));
    } 
    else //Updating existing user
    {
        
        $result = $userProgressCol->update($userDataExist, array("username" => $user, "data" => $storageData));
    }
    echo json_encode($return);
?>
