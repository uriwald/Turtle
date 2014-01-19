<?php
    $username                   =   $_POST['username'];
    $programCode                =   $_POST['programCode'];
    $programtitle               =   $_POST['programtitle'];
    $programUpdate              =   $_POST['update'];
    $programId                  =   $_POST['programid'];
    
    $return['programId']        =   $programId;
    $return['username']         =   $username; 
    $return['programCode']      =   $programCode;
    $return['programUpdate']    =   $programUpdate;
    $lastUpdated                =   date('Y-m-d H:i:s');
    
    $m                          =   new Mongo();
    $db                         =   $m->turtleTestDb;
    $userPrograms               =   "programs";
    $userProgramsCollection     =   $db->$userPrograms;
    

    if ($programUpdate == "false")
    {
        $return['isFirstUserProgram'] = true;
        $structure = array("username" => $username, "dateCreated" => $lastUpdated ,"displayInProgramPage" => false , "lastUpdated" => $lastUpdated , "programName" => $programtitle ,
                                        "code" => $programCode , "numOfComments" => "0" , "comments" => "");
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
        $numOfComments = $criteria["numOfComments"];
        $comments = $criteria["comments"];
        $dipp = $criteria["displayInProgramPage"];
        
        $structure = array("username" => $username, "dateCreated" => $dateCreated , "displayInProgramPage" => $dipp , 
            "lastUpdated" => $lastUpdated , "programName" => $programtitle ,"code" => $programCode , "numOfComments" => $numOfComments , "comments" => $comments);
        $result = $userProgramsCollection->update($criteria, array('$set' => $structure));

         
         
    }

    echo json_encode($return);
?>
