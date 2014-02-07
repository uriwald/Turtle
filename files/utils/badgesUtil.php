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
   
   public static function get_user_badges($username) 
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
            $exist_username = $users->count($queryUsername);
            $badges = "";
            //Check if email already exist then we will continue
            if ($exist_username > 0) { 
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
   public static function update_user_badges($username)
   {
       //Getting the corrent user badges
       $nuberOfBadges       =   3;
       $badges              =   self :: get_user_badges($username);
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
            $user_progress   = $db->user_progress;
            $user           = $user_progress->findOne(array("username" => $username));
            
            if (isset($user['stepCompleted']))
            {
                $steps_completed_arr = explode(",", $user['stepCompleted']);
                //print_r($stepsCompletedArr);
                $controll_badge_arr = array ("q(1)1","q(1)2","q(1)3","q(1)4","q(1)5","q(1)6","q(1)7");
                $controll_badge_iterator = 0;
                
                $badgeone = false;
                $badgetwo = false;
                
                //Function for checking the badge for completing the first lesson
                if (!in_array("1", $badgesArr)) 
                {
                    foreach ($steps_completed_arr as $step=>$val)
                    {

                        if ($val == $controll_badge_arr[$controll_badge_iterator])
                        {
                            $controll_badge_iterator++;
                            if ($controll_badge_iterator == 7)
                                break;
                        }             
                    }
                    //If a badge should be added we will update db and the Session
                    if ($controll_badge_iterator == 7)
                    {
                        badgesUtil :: add_user_badge_to_db("1,",$username);
                        $_SESSION['ubadges'] = "1,";
                        $badgeone = true;
                        $badgesWonStr = $badgesWonStr . "you won your first badge";

                    }
                }else {
                    $badgeone = true;
                }
                //// End of checking for badge number 1
                //Check for second badge 
                //If we didn't yet win the second badge but we did win the first badge
                if (!in_array("2", $badgesArr) && $badgeone ) {
                    $controll_badge_iterator = 0;
                    $controll_badge_arr = array ("q(2)1","q(2)2","q(2)3","q(2)4","q(2)5","q(2)6","q(2)7","q(2)8");
                    foreach ($steps_completed_arr as $step=>$val)
                    {
                        if ($val == $controll_badge_arr[$controll_badge_iterator])
                        {
                       
                            $controll_badge_iterator++;
                            if ($controll_badge_iterator == 8)
                                break;
                        }             
                    }
                    //If a badge should be added we will update db and the Session
                    if ($controll_badge_iterator == 8)
                    {
                        
                        badgesUtil :: add_user_badge_to_db("2,",$username);
                        $_SESSION['ubadges'] = "1,2,";
                        $badgetwo = true;
                        $badgesWonStr = " you won your second badge";
                        
                    }
                } // End of checking for badge number 2
                // Only if the badge number 2 was in the array and also badge 1
                else if ($badgeone) {
                    $badgetwo = true;
                }
                //If we didn't won badge number 3 yet but we won number 1 and 2
                if (!in_array("3", $badgesArr) && $badgeone && $badgetwo) {
                    $controll_badge_iterator = 0;
                    $controll_badge_arr = array ("q(3)1","q(3)2","q(3)3","q(3)4","q(3)5","q(3)6","q(3)7","q(3)8","q(3)9","q(3)10",
                                                "q(4)1","q(4)2","q(4)3","q(4)4","q(4)5","q(4)6"); 
                    foreach ($steps_completed_arr as $step=>$val)
                    {
                        if ($val == $controll_badge_arr[$controll_badge_iterator])
                        {
                       
                            $controll_badge_iterator++;
                            if ($controll_badge_iterator == 16)
                                break;
                        }             
                    }
                    //If a badge should be added we will update db and the Session
                    if ($controll_badge_iterator == 16)
                    {
                        
                        badgesUtil :: add_user_badge_to_db("3,",$username);
                        $_SESSION['ubadges'] = "1,2,3,";
                        $badgesWonStr = " you won your Third badge";
                        
                    }
                    else
                        $badgesWonStr = $controll_badge_iterator;
                } // End of checking for badge number 2
            }   
        } // End of ifset stepCompleted
        return $badgesWonStr;
   }
   private static function add_user_badge_to_db ($badgeName , $username)
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
        if ($user != null)
        {
            $users->update($user , $newuser);
        }
        
        
   }
      /*
    *  set user badges 
    *  Will set the user new badges
    *   
    */
   
   public static function set_user_badges($username , $badges)
   {
       
   }
}

?>
