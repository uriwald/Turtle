<?php

$return["nothi"] = "nothing";

$sendfrom = $_POST['sendfrom'];
$sendto = $_POST['sendto'];
$context = $_POST['context'];
$subject = $_POST['subject'];

$flag = true;

if ($flag) {

    $m = new Mongo();
    $db = $m->turtleTestDb;
    $strcol = $db->messages;

    $date = date('Y-m-d H:i:s');
    $readStatus = false;
    if ($sendto =='all')
        $readStatus = true;
    $obj = array("sendfrom" => $sendfrom , "sendto" => $sendto,  "date" => $date 
        ,"subject" => $subject,"content"=>$context , "read" => false);
    $result = $strcol->insert($obj);


    echo json_encode($return);
}
?>