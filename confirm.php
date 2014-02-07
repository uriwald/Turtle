<?php
    $inc_dir_path = "files/registration/inc/";
    include_once $inc_dir_path . 'php/config.php';
    include_once $inc_dir_path . 'php/functions.php';
    //include_once $incDirPath . 'elements/confirmHeader.php';
    
    require_once("localization.php");
    require_once("environment.php");
   

    $locale = "en_US";
    if (isset($_GET['locale']))
        $locale = $_GET['locale'];

    $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
    $po_file =  "<link   rel='gettext' type='application/x-po' href='".$root_dir."locale/".$locale."/LC_MESSAGES/messages.po'"." />";       
    if ( file_exists($file_path))
        echo $po_file;            
    include_once 'confirmHeader.php';
    //require_once("confirmHeader.php");

//setup some variables
$action = array();
$action['result'] = null;
$istest =   false;

//check if the $_GET variables are present
//quick/simple validation 
//String to be translated
$str_user_confrim         = _("User has been confirmed");
$str_thanks              = _("Thank you");
$str_please              = _("Please");
$str_missing             = _("We are missing email address or generated key");
$str_double_check         = _("Please double check your email");
$str_email_key_not_appear   = _("The key or email doesn't appear in our database");

if (empty($_GET['email']) || empty($_GET['key'])) {
    if ($istest)
    {
        $action['result']   = 'success';

        $action['text']     = $str_user_confrim .". ".$str_thanks ."! ".$str_please . "<a href='". $root_dir . "registration.php'>" .  _('login')  . "</a>";
        //"User has been confirmed. Thank-You! please <a href='" . $rootDir . "registration.php'>" .  _('login')  . "</a>" ; ?> 
            <?php
    }
    else
    {
        $action['result']       = 'error';
        $action['text']         = $str_missing . ". " .$str_double_check .".";
                //We are missing email address or generated key. Please double check your email.';
    }
}

if ($action['result'] != 'error' && !$istest) {
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $users_confirmation = $db->users_waiting_approvment;
    $users = $db->users;
    //cleanup the variables
    $email = $_GET['email'];
    $key = $_GET['key'];

    //check if the key is in the database
    //$check_key = mysql_query("SELECT * FROM `confirm` WHERE `email` = '$email' AND `key` = '$key' LIMIT 1") or die(mysql_error());
    $userQuery = array('email' => $email, 'key' => $key);
    $check_key = $users_confirmation->findOne($userQuery);
    $resultcount = $users_confirmation->count($userQuery);

    //$uesrid; 
    //foreach ($check_key as $doc) {
    //    $uesrid = $doc['userid'];
    // 
    $uesrid = $check_key['userid'];
    $confirmid = $check_key['_id'];
    $confirm_id_mongo = new MongoId($confirmid);
    if ($resultcount != 0) {
        //get the confirm info
        $the_object_id = new MongoId($uesrid);
        $criteria = $users->findOne(array("_id" => $the_object_id));
        $criteria_update = $criteria;
        $criteria_update['confirm'] = true;

        $update_users = $users->update($criteria, $criteria_update);
        $result = $users_confirmation->remove(array('_id' => $confirm_id_mongo), array("justOne" => true));
        if ($update_users) {
            $action['result'] = 'success';
            $action['text']     = $str_user_confrim .". ".$str_thanks ."! ".$str_please . "<a href='". $root_dir . "registration.php'>" .  _('login')  . "</a>";
        } else {
            $action['result'] = 'error';
            $action['text'] = 'The user could not be updated Reason: ';
        }
    } else {
        $action['result'] = 'error';
        $action['text'] = $str_email_key_not_appear;
    }
}
?>

<?php echo show_errors($action); ?>

<?php

include $inc_dir_path . 'elements/footer.php';
?>