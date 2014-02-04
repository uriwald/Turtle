<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once 'files/openid.php';
require_once("environment.php");
$openid = new LightOpenID($sitePath);
 
if ($openid->mode) {
    if ($openid->mode == 'cancel') {
        echo "User has canceled authentication !";
    } elseif($openid->validate()) {
        $data               =   $openid->getAttributes();
        $email              =   $data['contact/email'];
        $user['username']   =   $email;
        $user['password']   =   md5($email);
        $user['badges']     =   "";
        $user['confirm']    =   true ;
        $user['email']      =   $email;
        $user['fullname']   =   $data['namePerson/first'] . " " . $data['namePerson/last'] ;
        $user['pref/language'] = $data['pref/language'];
        $date = date('Y-m-d H:i:s');
        $user['date'] = $date;
        

        
        //print_r($user);

        $m = new Mongo();
        $db = $m->turtleTestDb;
        $users = $db->users;

        $userExist = array('email' => $email , 'username'=>$email);
        $resultcount = $users->count($userExist);
        if ($resultcount == 0)      
            $users->insert($user, array('safe' => true)); 
        else
        {
            //echo "Do nothing";
        }
        $currentUser    =   $users->findOne($userExist);
        if (isset($currentUser['institute']))
        {
            $_SESSION['institute'] = $currentUser['institute'];
            $_SESSION['institute_email'] = $currentUser['email'];
            $_SESSION['institute_name'] = $currentUser['institute_name'];
            $_SESSION['institute_description'] = $currentUser['institute_description'];
        }
         $_SESSION['username'] = $email;
         $_SESSION['isOpenID'] = true;
         
         header( 'Location: index.php' ) ; 
    } else {
        echo "The user has not logged in";
    }
} else {
    echo "Go to index page to log in.";
}
?>