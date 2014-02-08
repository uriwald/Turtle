<?php
    require_once("../environment.php");
    require_once("utils/collectionUtil.php");
    
    $username                   =   $_POST['username'];
    $program_id                  =   $_POST['programid'];
    $cmt                        =   $_POST['comment'];
    
    $return['programId']        =   $program_id;
    $date                =   date('Y-m-d H:i:s');
    
    $m                          =   new Mongo();
    $db                         =   $m->turtleTestDb;
    $user_programs               =   "programs";
    $user_Programs_Collection     =   $db->$user_programs;
    $newComment = array("user" => $username , "time" => $date , "comment" => $cmt );
    //Fetching the current object
    $the_object_id                   =   new MongoId($program_id);
    $criteria                   =   $user_Programs_Collection->findOne(array("_id" => $the_object_id));
    $commentOld                 =   $criteria['comments'];
    $commentUpdated             =   $commentOld;
    $commentUpdated[]           =   $newComment;
    $numOfComments              =   $criteria['numOfComments'];
    $numOfComments++;
    collectionUtil ::collection_item_change_attrivute_val ("turtleTestDb","programs" ,$the_object_id , "comments"  , $commentUpdated);
    collectionUtil ::collection_item_change_attrivute_val ("turtleTestDb","programs" ,$the_object_id , "numOfComments"  , $numOfComments);

    echo json_encode($return);
?>
