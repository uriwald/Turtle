<?php
/**
 *  This class will hold functions for managing users badges
 *  Add a new badge , update existing badge  
 *  view user badges 
 */

class badgesUtil {
    
   /*
    *  Get user badges 
    *  Will get the user badges currently store in db
    *  @return badgesList 
    */
   
   public static function getUserBadges($username)
   {
        $m = new Mongo();
        $db = $m->turtleTestDb;
        $users = $db->users;
        $queryUsername = array('username' => $username, "confirm" => true);
        $existUsername = $users->count($queryUsername);
        $badges = "";
        if ($existUsername > 0) { //Check if email already exist then we will continue
                $curretnUser = $users->findOne($queryEmail);
                $badges = $curretnUser['badges'];
        }
        return $badges;
   }
   /*
    * update user badges
    * Will check according to the user steps if the user should reward a new badge
    */ 
   public static function updateUserBadges($username)
   {
        $m              = new Mongo();
        $db             = $m->turtleTestDb;	
        $userProgress   = $db->user_progress;
        $user           = $userProgress->findOne(array("username" => $username));
       
        if (isset($user['stepCompleted']))
        {
            echo "sdfs";
            $stepsCompletedArr = explode(",", $user['stepCompleted']);
            print_r($stepsCompletedArr);
            $controllBadgeArr = array ('q(1)1','q(1)2',"q(1)3","q(1)4","q(1)5","q(1)6","q(1)7");
            $controllBadgeIterator = 0;

            foreach ($stepsCompletedArr as $step=>$val)
            {
                $val = substr($val,1);
                if ($val == $controllBadgeArr[$controllBadgeIterator])
                {
                    echo "Identicale";
                    $controllBadgeIterator++;
                }
                else
                    echo " not identicale**";
            }
            
        }
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
