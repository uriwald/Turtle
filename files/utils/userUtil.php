<?php
     class userUtil {
         
     public static function varifyUser($username , $password) 
     {
           $password = md5($password); 
           $m = new Mongo();
           $db = $m->turtleTestDb;	
           $users = $db->users;
           
           $userQuery       = array('username' => $username , 'password' => $password , 'confirm'=> true);
           $resultcount     = $users->count($userQuery);
           //Case no user found
           if ($resultcount == 0)
               return false;
           else
           {
               self::user_login_log($username , $db);
               
               return true;
           }
     }
     /*
      * Putting user login info
      */
     private static function user_login_log($username , $db)
     {
         $loginTime = date("Y-m-d H:i:s");
         $loginUser   =   $db->users_login ;
         //Check if user already exist
         $userQuery       = array('username' => $username );
         $resultcount     = $loginUser->count($userQuery);
         //if exist do
         if ($resultcount > 0){
             $criteria = $loginUser->findOne(array('username' => $username ));
             $loggedinfo    =   $criteria['logged'];
             $loggedinfo  .= " ," . $loginTime;
             $result = $loginUser->update($criteria, array('$set' => array("username" => $username, "logged" => $loggedinfo)));
         }
         
         //else do
         else{
                $structure = array("username" => $username, "logged" => $loginTime);
                $result = $loginUser->insert($structure, array('safe' => true));
         }
     } 
     
     /*
      * Getting the username
      * if the username equal to Admin then show all lessons
      */
     public static function showUserLessons($username) 
     {
           $m = new Mongo();
           $db = $m->turtleTestDb;	
           $users = $db->lessons_created_by_guest;
           if ($username == "lucio")
           {
               $results     = $users->find();
           }
           else {
           $userQuery       =  array('username' => $username);
           $results     = $users->find($userQuery);
           }
           //Case no user found
               return $results;
     }
  
    }
?>
