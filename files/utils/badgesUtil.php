<?php
/**
 *  This class will hold functions for managing users badges
 *  Add a new badge , update existing badge  
 *  view user badges 
 */
//Active session class
    if (session_id() == '')
    {
        session_start();
    }
class badgesUtil {
    
   /*
    *  Get user badges 
    *  Will get the user badges currently store in db
    *  @return badgesList 
    */
   
   public static function getUserBadges($username) 
   {
        //First try to get the badges from session , if not access db
       if (isset($_SESSION['ubadges']))
       {
            return $_SESSION['ubadges'];
       }
       else { 
            $m = new Mongo();
            $db = $m->turtleTestDb;
            $users = $db->users;

            $queryUsername = array('username' => $username, "confirm" => true);
            $existUsername = $users->count($queryUsername);
            $badges = "";
            //Check if email already exist then we will continue
            if ($existUsername > 0) { 
                    $curretnUser = $users->findOne($queryUsername);
                    if (isset($curretnUser['badges']))
                        $badges = $curretnUser['badges'];
            }
            return $badges;
       }
      
   }
   /*
    * update user badges
    * Will check according to the user steps if the user should reward a new badge
    */ 
   public static function updateUserBadges($username)
   {
       //Getting the corrent user badges
       $nuberOfBadges       =   3;
       $badges              =   self :: getUserBadges($username);
       $badgesArr           =   explode(",",$badges); 
       $numOfUserBadges     =   count($badgesArr) - 1;
       $badgesWonStr = "";
        //If all user have all badges no need to further check
        if ($numOfUserBadges == $nuberOfBadges ){
           // echo " User has all badges";
        }
        else
        {  
        //if User have some badges their condition shouldn't be check
            $m              = new Mongo();
            $db             = $m->turtleTestDb;	
            $userProgress   = $db->user_progress;
            $user           = $userProgress->findOne(array("username" => $username));
            
            if (isset($user['stepCompleted']))
            {
                $stepsCompletedArr = explode(",", $user['stepCompleted']);
                //print_r($stepsCompletedArr);
                $controllBadgeArr = array ("q(1)1","q(1)2","q(1)3","q(1)4","q(1)5","q(1)6","q(1)7");
                $controllBadgeIterator = 0;
                
                $badgeone = false;
                $badgetwo = false;
                
                //Function for checking the badge for completing the first lesson
                if (!in_array("1", $badgesArr)) 
                {
                    foreach ($stepsCompletedArr as $step=>$val)
                    {

                        if ($val == $controllBadgeArr[$controllBadgeIterator])
                        {
                            $controllBadgeIterator++;
                            if ($controllBadgeIterator == 7)
                                break;
                        }             
                    }
                    //If a badge should be added we will update db and the Session
                    if ($controllBadgeIterator == 7)
                    {
                        badgesUtil :: addUserBadgeToDb("1,",$username);
                        $_SESSION['ubadges'] = "1,";
                        $badgeone = true;
                        $badgesWonStr = $badgesWonStr . "you won your first badge";

                    }
                }
                else {
                    $badgeone = true;
                }
                //// End of checking for badge number 1
                //Check for second badge 
                if (!in_array("2", $badgesArr) && $badgeone ) {
                    $controllBadgeIterator = 0;
                    $controllBadgeArr = array ("q(2)1","q(2)2","q(2)3","q(2)4","q(2)5","q(2)6","q(2)7","q(2)8");
                    foreach ($stepsCompletedArr as $step=>$val)
                    {
                        if ($val == $controllBadgeArr[$controllBadgeIterator])
                        {
                       
                            $controllBadgeIterator++;
                            if ($controllBadgeIterator == 8)
                                break;
                        }             
                    }
                    //If a badge should be added we will update db and the Session
                    if ($controllBadgeIterator == 8)
                    {
                        
                        badgesUtil :: addUserBadgeToDb("2,",$username);
                        $_SESSION['ubadges'] = "1,2,";
                        $badgetwo = true;
                        $badgesWonStr = " you won your second badge";
                        
                    }
                } // End of checking for badge number 2
                else {
                    $badgetwo = true;
                }
                if (!in_array("3", $badgesArr)) {
                    $controllBadgeIterator = 0;
                    $controllBadgeArr = array ("q(3)1","q(3)2","q(3)3","q(3)4","q(3)5","q(3)6","q(3)7","q(3)8","q(3)9","q(3)10",
                                                "q(4)1","q(4)2","q(4)3","q(4)4","q(4)5","q(4)6"); 
                    foreach ($stepsCompletedArr as $step=>$val)
                    {
                        if ($val == $controllBadgeArr[$controllBadgeIterator])
                        {
                       
                            $controllBadgeIterator++;
                            if ($controllBadgeIterator == 16)
                                break;
                        }             
                    }
                    //If a badge should be added we will update db and the Session
                    if ($controllBadgeIterator == 16)
                    {
                        
                        badgesUtil :: addUserBadgeToDb("3,",$username);
                        $_SESSION['ubadges'] = "1,2,3,";
                        $badgesWonStr = " you won your Third badge";
                        
                    }
                    else
                        $badgesWonStr = $controllBadgeIterator;
                } // End of checking for badge number 2
            }   
        } // End of ifset stepCompleted
        return $badgesWonStr;
   }
   private static function addUserBadgeToDb ($badgeName , $username)
   {
        $m              = new Mongo();
        $db             = $m->turtleTestDb;	
        $users          = $db->users;
        $user           = $users->findOne(array("username" => $username));
        
        $newuser = $user;
        $badges = "";
        if (isset($user['badges']))
        {
            $badges  = $user['badges'];
            if (strpos($badges,$badgeName) !== false) {
                echo 'true';
                exit;
            }   
        }
        $badges = $badges . $badgeName;
        $newuser['badges'] = $badges;
        $users->update($user , $newuser);
        
        
        
   }
      /*
    *  set user badges 
    *  Will set the user new badges
    *   
    */
   
   public static function setUserBadges($username , $badges)
   {
       
   }
}

?>
