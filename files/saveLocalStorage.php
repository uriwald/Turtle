<?php
    require_once 'utils/badgesUtil.php';
    
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
    $cmd         = "";
    $tocmd       = "";
    $addNewToCmd = false; // If we will have to save a new user TO command
    if (isset($_POST['command']))
    {
        $cmd = $_POST['command'];
        $trimmedcmd = trim($cmd);
        if (strcasecmp(substr($trimmedcmd, 0, 2), "to") == 0) 
        {
            $tocmd = $trimmedcmd;
            $addNewToCmd = true;
        }
        //else
        //    echo"unhapoyp";

    }
    $return['username']     = $user;
    $stepsComletedData      = "";  
    $userActions            = ""; // Will represent the user history already save for the user
    $userActionsUpdate      = ""; // The new user actions that should be save to history
    $isLessonStep           = false;
    $isHistory              = false;
    $date                   = date('Y-m-d H:i:s');
    if (isset($_POST['lclStoragevalues']))
    {
        $stepsComletedData      = $_POST['lclStoragevalues'];   
        $return['lclsValues']   = $stepsComletedData ;
        $isLessonStep           = true;
    }  
    if (isset($_POST['userHistory']))
    {
        $userActionsUpdate      =   $date . " ->" .$_POST['userHistory'];   
        $return['userActions']  =   $userActionsUpdate ;
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
    $return['numberOfMathingUsers'] = $resultcount;
    //Case we need to add a new record to db
    if (!$resultcount > 0 ) 
    {
        $return['isNewUser'] = true;
        $structure = array("username" => $user, "stepCompleted" => $stepsComletedData 
            , "userHistory" => $userActionsUpdate , "lastUpdate" => $date , "tocmd" => $tocmd);
        $result = $userProgressCol->insert($structure, array('safe' => true));
        $newDocID = $structure['_id'];
        $return['programID'] = $newDocID;
        
    } 
    else //Updating existing user
    {
        $return['isNewUser'] = false;
       // if ($isLessonStep)
            $userActions = $userDataExist['userHistory'];
        if ($isHistory)
        {
            $stepsComletedData = $userDataExist['stepCompleted'];   
        }
        //If The user has a privouse To command saved
        $toCommands="";
        if (isset($userDataExist['tocmd']))
        {
            $toCommands = $userDataExist['tocmd'];
             if ($addNewToCmd)
             {
                $toCommands = $toCommands . ", " .$tocmd; 
             }
        }
        else
        {
            $toCommands = $tocmd;
        }
            
       
        {
           
            $userDataExist['tocmd'];
        }
 
        $userActions = $userActions . " , " .$userActionsUpdate ;
           $return['userActions']  =   $userActions ;

        $result = $userProgressCol->update($userDataExist, array("username" => $user,  "lastUpdate" => $date ,
            "stepCompleted" => $stepsComletedData , "userHistory" => $userActions , "tocmd" => $toCommands));
    }
     $return['badge'] = "no";
    if (isset($_SESSION[$username]))
    {
        $return['badge']    =   badgesUtil :: updateUserBadges($user); 
        $return['user']     =   $user;
        
    }

    echo json_encode($return);
?>
