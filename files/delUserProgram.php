<?php
    $username                   =   $_POST['username'];
    $program_id                  =   $_POST['programid'];
    
    $return['programId']        =   $program_id;
    $return['username']         =   $username; 

    
    $m                          =   new Mongo();
    $db                         =   $m->turtleTestDb;
    $user_programs               =   "programs";
    $userProgramsCollection     =   $db->$user_programs;
    $the_object_id                   =   new MongoId($program_id);
    $userProgramsCollection->remove(array("_id" => $the_object_id), array("username" => $username));
    echo json_encode($return);
?>