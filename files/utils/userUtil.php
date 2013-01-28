<?php
     class userUtil {
         
     public static function varifyUser($username , $password) 
     {
           $password = md5($password); 
           $m = new Mongo();
           $db = $m->turtleTestDb;	
           $users = $db->user_test;
           
           $userQuery       = array('username' => $username , 'password' => $password , 'confirm'=> true);
           $resultcount     = $users->count($userQuery);
           //Case no user found
           if ($resultcount == 0)
               return false;
           else
               return true;
     }

    }
?>
