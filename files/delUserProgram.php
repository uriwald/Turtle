<?php
    $username                   =   $_POST['username'];
    $programId                  =   $_POST['programid'];
    
    $return['programId']        =   $programId;
    $return['username']         =   $username; 

    
    $m                          =   new Mongo();
    $db                         =   $m->turtleTestDb;
    $userPrograms               =   "programs";
    $userProgramsCollection     =   $db->$userPrograms;
    $theObjId                   =   new MongoId($programId);
    $userProgramsCollection->remove(array("_id" => $theObjId), array("username" => $username));
    echo json_encode($return);
?>