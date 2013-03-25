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
        $data = $openid->getAttributes();
        
        $m = new Mongo();
        $db = $m->turtleTestDb;
        $userOI = $db->user_open_id;
        //Search if user exist
        $email = $data['contact/email'];
        $first = $data['namePerson/first'];
        $userExist = array('contact/email' => $email);
        $resultcount = $userOI->count($userExist);
        if ($resultcount == 0)      
            $userOI->insert($data, array('safe' => true));
        else
        {
            echo "Do nothing";
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