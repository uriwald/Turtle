<?php
    require_once("../environment.php");
    require_once("utils/collectionUtil.php");
    
    $username                   =   $_POST['username'];
    $programId                  =   $_POST['programid'];
    $cmt                        =   $_POST['comment'];
    
    $return['programId']        =   $programId;
    $date                =   date('Y-m-d H:i:s');
    
    $m                          =   new Mongo();
    $db                         =   $m->turtleTestDb;
    $userPrograms               =   "programs";
    $userProgramsCollection     =   $db->$userPrograms;
    $newComment = array("user" => $username , "time" => $date , "comment" => $cmt );
    //Fetching the current object
    $theObjId                   =   new MongoId($programId);
    $criteria                   =   $userProgramsCollection->findOne(array("_id" => $theObjId));
    $commentOld                 =   $criteria['comments'];
    $commentUpdated             =   $commentOld;
    $commentUpdated[]           =   $newComment;
    $numOfComments              =   $criteria['numOfComments'];
    $numOfComments++;
    collectionUtil ::CollectionItemChangeAttVal ("turtleTestDb","programs" ,$theObjId , "comments"  , $commentUpdated);
    collectionUtil ::CollectionItemChangeAttVal ("turtleTestDb","programs" ,$theObjId , "numOfComments"  , $numOfComments);
    // collectionUtil :: addPropertyToAllCollectionObjects("programs" , "comments" , $commentUpdated); 
    /*

    if ($programUpdate == "false")
    {
        $return['isFirstUserProgram'] = true;
        $structure = array("username" => $username, "dateCreated" => $lastUpdated ,"displayInProgramPage" => false , "lastUpdated" => $lastUpdated , "programName" => $programtitle ,
                                        "code" => $programCode);
        $result = $userProgramsCollection->insert($structure, array('safe' => true));
        $newDocID = $structure['_id'];
        $return['programId'] = $newDocID; 
    }
    else
    {
        //Fetching the current object
        $theObjId                   =   new MongoId($programId);
        $criteria                   =   $userProgramsCollection->findOne(array("_id" => $theObjId));
        //Changing all the values but createdDate
        $dateCreated = $criteria["dateCreated"];
        $structure = array("username" => $username, "dateCreated" => $dateCreated , "displayInProgramPage" => false , 
            "lastUpdated" => $lastUpdated , "programName" => $programtitle ,"code" => $programCode);
        $result = $userProgramsCollection->update($criteria, array('$set' => $structure));

         
         
    }
    */
    echo json_encode($return);
?>
