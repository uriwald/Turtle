<?php
$incDirPath = "files/registration/inc/";
include_once $incDirPath . 'php/config.php';
include_once $incDirPath . 'php/functions.php';
include_once $incDirPath . 'elements/header.php';

//setup some variables
$action = array();
$action['result'] = null;
$istest =   false;

//check if the $_GET variables are present
//quick/simple validation 
if (empty($_GET['email']) || empty($_GET['key'])) {
    if ($istest)
    {
        $action['result'] = 'success';
        $action['text'] = "User has been confirmed. Thank-You! please <a href='" . $rootDir . "registration.php'>" .  _('login')  . "</a>" ; ?> 
            <?php
    }
    else
    {
        $action['result'] = 'error';
        $action['text'] = 'We are missing email address or generated key. Please double check your email.';
    }
}

if ($action['result'] != 'error' && !$istest) {
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $usersconfirmation = $db->users_waiting_approvment;
    $users = $db->users;
    //cleanup the variables
    $email = $_GET['email'];
    $key = $_GET['key'];

    //check if the key is in the database
    //$check_key = mysql_query("SELECT * FROM `confirm` WHERE `email` = '$email' AND `key` = '$key' LIMIT 1") or die(mysql_error());
    $userQuery = array('email' => $email, 'key' => $key);
    $check_key = $usersconfirmation->findOne($userQuery);
    $resultcount = $usersconfirmation->count($userQuery);

    //$uesrid; 
    //foreach ($check_key as $doc) {
    //    $uesrid = $doc['userid'];
    // }
    $uesrid = $check_key['userid'];
    $confirmid = $check_key['_id'];
    $confirmidMongo = new MongoId($confirmid);
    if ($resultcount != 0) {
        //get the confirm info
        $theObjId = new MongoId($uesrid);
        $criteria = $users->findOne(array("_id" => $theObjId));
        $criteriaUpdate = $criteria;
        $criteriaUpdate['confirm'] = true;

        $update_users = $users->update($criteria, $criteriaUpdate);
        $result = $usersconfirmation->remove(array('_id' => $confirmidMongo), array("justOne" => true));
        if ($update_users) {
            $action['result'] = 'success';
            $action['text'] = 'User has been confirmed. Thank-You!';
        } else {
            $action['result'] = 'error';
            $action['text'] = 'The user could not be updated Reason: ';
        }
    } else {
        $action['result'] = 'error';
        $action['text'] = 'The key and email is not in our database.';
    }
}
?>

<?php echo show_errors($action); ?>

<?php

include $incDirPath . 'elements/footer.php';
?>