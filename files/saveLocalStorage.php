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
    $date = date('Y-m-d H:i:s');
    $resultcount        = $userProgressCol->count($userQuery);
    $return['numberOfMathingUsers'] = $resultcount;
    //Case we need to add a new record to db
    if (!$resultcount > 0 ) 
    {
        $return['isNewUser'] = true;
        $structure = array("username" => $user, "stepCompleted" => $stepsComletedData , "userHistory" => $userHistory , "lastUpdate" => $date);
        $result = $userProgressCol->insert($structure, array('safe' => true));
    } 
    else //Updating existing user
    {
        $return['isNewUser'] = false;
        if ($isLessonStep)
            $userHistory = $userDataExist['userHistory'];
        if ($isHistory)
            $stepsComletedData = $userDataExist['stepCompleted'];      
            
        $result = $userProgressCol->update($userDataExist, array("username" => $user,  "lastUpdate" => $date , "stepCompleted" => $stepsComletedData , "userHistory" => $userHistory));
    }
    echo json_encode($return);
?>
