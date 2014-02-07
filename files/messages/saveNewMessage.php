<?php
require_once '../../environment.php';
$return["nothi"] = "nothing";
$m = new Mongo();
$db = $m->turtleTestDb;
$strcol = $db->messages;
$date = date('Y-m-d H:i:s');// Case of system message

if (!isset($_POST['programid']))
{
    $sendfrom = $_POST['sendfrom'];
    $sendto   = $_POST['sendto'];
    $context  = $_POST['context'];
    $subject  = $_POST['subject'];

    $readStatus = false;
    if ($sendto =='all')
        $readStatus = false; // Will be mark as unread in 2 days
    $obj = array("sendfrom" => $sendfrom , "realSender"=> $sendfrom , "sendto" => $sendto,  "date" => $date 
        ,"subject" => $subject,"content"=>$context , "read" => false);
    $result = $strcol->insert($obj);
}
else { // Case of program 
    $sendfrom       = "System";
    $creator        = $_POST['programCreator'];
    $programid      = $_POST['programid'];
    $realSender     = $_POST['username'];
    $programSubject = $_POST['programSubject'];
    $cmt            = $_POST['comment'];
    
    $subject = "Your program has been commented";
    $context = "Hello $creator,
<span class='creator'><b>$realSender</b></span> just commented your program <b>$programSubject</b> :
'$cmt'
for more info pleaes view the following link <a href='$site_path/users/programs/$programid'> Here </a>";
    $obj = array("sendfrom" => $sendfrom , "realSender"=> $realSender , "sendto" => $creator,  "date" => $date 
        ,"subject" => $subject,"content"=>$context , "read" => false);
    $result = $strcol->insert($obj);  
                        
}
 echo json_encode($return);
?>