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
    $stepsComletedData    = "";  
    $stepError  =   "dd";
    if (isset($_POST['errorStep']) && isset($_POST['errorString']))
    {
        $errorStep              =   $_POST['errorStep']; 
        $errorString            =   $_POST['errorString']; 
        $stepError              =   $errorStep . " - " . $errorString;
       
    }   
    $m                      =   new Mongo();
    $db                     =   $m->turtleTestDb;
    $userProgress           =   "user_errors";
    $userProgressCol        =   $db->$userProgress;   
    //Checking if the user already has some data
    $userQuery              = array('username' => $user);
    $userDataExist          = $userProgressCol->findOne($userQuery);
    $resultcount            = $userProgressCol->count($userQuery);
    
    //Case we need to add a new record to db
    if (!$resultcount > 0 ) 
    { 
        $structure = array("username" => $user, "stepError" => $stepError);
        $result = $userProgressCol->insert($structure, array('safe' => true));
        $return["Insert"] = "insert";
    } 
    else //Updating existing user
    {
        
        $myUserData         = $userDataExist["stepError"];
        $myUserData         = $myUserData . " , " . $stepError;
        $result             = $userProgressCol->update($userDataExist, array("username" => $user ,"stepError" => $myUserData));
        $return["userdata"] = "update";
    }
    echo json_encode($return);
?>
