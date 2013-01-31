<?php
$incDirPath = "files/registration/inc/";
include_once $incDirPath . 'php/config.php';
include_once $incDirPath . 'php/functions.php';
include $incDirPath . 'elements/header.php';

//setup some variables
$action = array();
$action['result'] = null;

//check if the $_GET variables are present
//quick/simple validation 
if (empty($_GET['email']) || empty($_GET['key'])) {
    $action['result'] = 'error';
    $action['text'] = 'We are missing variables. Please double check your email.';
}

if ($action['result'] != 'error') {
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $usersconfirmation = $db->users_waiting_approvment;
    $users = $db->users;
    //cleanup the variables
    //$email = mysql_real_escape_string($_GET['email']);
    //$key = mysql_real_escape_string($_GET['key']);
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
    //echo " confirm Id is ,, " . $confirmid;
    //echo $uesrid;
    // if(mysql_num_rows($check_key) != 0){
    if ($resultcount != 0) {
        //get the confirm info
        //$confirm_info = mysql_fetch_assoc($check_key);
        //Won't be use in here
        //confirm the email and update the users database
        //$update_users = mysql_query("UPDATE `users` SET `active` = 1 WHERE `id` = '$confirm_info[userid]' LIMIT 1") or die(mysql_error());
        $theObjId = new MongoId($uesrid);
        $criteria = $users->findOne(array("_id" => $theObjId));
        $criteriaUpdate = $criteria;
        $criteriaUpdate['confirm'] = true;
        //echo " Criteria is : " ;
        //var_dump($criteria);
        //echo "Criteria update confirm = " . $criteriaUpdate["confirm"];
        $update_users = $users->update($criteria, $criteriaUpdate);
        //
        //delete the confirm row
        //$delete = mysql_query("DELETE FROM `confirm` WHERE `id` = '$confirm_info[id]' LIMIT 1") or die(mysql_error());

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