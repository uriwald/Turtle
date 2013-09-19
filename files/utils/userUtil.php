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
     /*
      * Add user property
      * will add new property the the user collection
      */
     public static function addPropertyToUserCol ($property , $val)
     {
           $m = new Mongo();
           $db = $m->turtleTestDb;	
           $users = $db->users;
           $cursor = $users->find();
            foreach ($cursor as $user) {
                $userobj = $user;
                $newdata = array('$set' => array($property => $val));
                $users->update($user, $newdata);
            } 
     }
     /*
      * Will copy privous collection object of userOpenId TO the Users collection
      */ 
    public static function copy_db_openid_user_to_users($username)
     {
         $m = new Mongo();
         $db = $m->turtleTestDb;	
         $usersOpenId = $db->user_open_id;
         $users = $db->users;
         //Check if user already exist in users db
         $userQuery       = array('username' => $username , 'email'=> $username);
         $resultcount     = $users->count($userQuery);
         //if User already exist in db do nothing else copy info between collection
         if ($resultcount > 0){
            // do Nothing
         }
         else
         {
            $OpenIdUser = $usersOpenId->findOne(array('contact/email' => $username));       
            //New user object definition
            $email                  =   $OpenIdUser['contact/email'];      
            $user['username']       =   $email;
            $user['password']       =   md5($email);
            $user['badges']         =   "";
            $user['confirm']        =   true ;
            $user['email']          =   $email;
            $user['fullname']       =   $OpenIdUser['namePerson/first'] . " " . $OpenIdUser['namePerson/last'] ;
            $user['pref/language']  =   $OpenIdUser['pref/language'];
            
            $result = $users->insert($user, array('safe' => true)); 
         }
     }
     /*
      * Will copy all open_id objects to users
      */ 
    public static function copy_db_all_openid_users_to_users()
     {
         $m = new Mongo();
         $db = $m->turtleTestDb;	
         $usersOpenIdCol = $db->user_open_id;
         $users = $db->users;
         
         $OpenIdUsers     = $usersOpenIdCol->find();
         $date = date('Y-m-d H:i:s');
         foreach ($OpenIdUsers as $OpenIdUser) {
                $email           =   $OpenIdUser['contact/email']; 
                $userQuery       = array('username' => $email , 'email'=> $email);
                $resultcount     = $users->count($userQuery);
                //if User already exist in db do nothing else copy info between collection
                if ($resultcount > 0){
                    // do Nothing
                }
                else
                {
                    $user = null;
                    //New user object definition   
                    $user['username']       =   $email;
                    $user['password']       =   md5($email);
                    $user['badges']         =   "";
                    $user['confirm']        =   true ;
                    $user['email']          =   $email;
                    $user['fullname']       =   $OpenIdUser['namePerson/first'] . " " . $OpenIdUser['namePerson/last'] ;
                    $user['pref/language']  =   $OpenIdUser['pref/language'];
                    $user['date']           =   $date;

                    $users->insert($user, array('safe' => true)); 
                }
         } 
         //Check if user already exist in users db
         
     }     
     
     
    }
?>
