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
               return true;
     }
     
     public static function showUserLessons($username) 
     {
           $m = new Mongo();
           $db = $m->turtleTestDb;	
           $users = $db->lessons_created_by_guest;
           
           $userQuery       = array('username' => $username);
           $results     = $users->find($userQuery);
           //Case no user found
               return $results;
     }
  
    }
?>
