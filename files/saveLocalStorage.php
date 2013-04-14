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
    $return['username']     = $user;
    $stepsComletedData      = "";  
    $userHistory            = "";
    $isLessonStep           = false;
    $isHistory           = false;
    if (isset($_POST['lclStoragevalues']))
    {
        $stepsComletedData      = $_POST['lclStoragevalues'];   
        $return['lclsValues']   = $stepsComletedData ;
        $isLessonStep           = true;
    }  
    if (isset($_POST['userHistory']))
    {
        $userHistory            =   $_POST['userHistory'];   
        $return['userHistory']  =   $userHistory ;
        $isHistory              = true;
    }  
    $m                  =   new Mongo();
    $db                 =   $m->turtleTestDb;
    $userProgress       =   "user_progress";
    $userProgressCol    =   $db->$userProgress;   
    //Checking if the user already has some data
    $userQuery          = array('username' => $user);
    $userDataExist      = $userProgressCol->findOne($userQuery);
    $resultcount        = $userProgressCol->count($userQuery);
    
    //Case we need to add a new record to db
    if (!$resultcount > 0 ) 
    {
        $structure = array("username" => $user, "stepCompleted" => $stepsComletedData , "userHistory" => $userHistory);
        $result = $userProgressCol->insert($structure, array('safe' => true));
    } 
    else //Updating existing user
    {
        
        if ($isLessonStep)
            $userHistory = $userDataExist['userHistory'];
        if ($isHistory)
            $stepsComletedData = $userDataExist['stepCompleted'];      
            
        $result = $userProgressCol->update($userDataExist, array("username" => $user, "stepCompleted" => $stepsComletedData , "userHistory" => $userHistory));
    }
    echo json_encode($return);
?>
